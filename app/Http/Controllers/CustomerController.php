<?php

namespace App\Http\Controllers;

use Throwable;
use App\Helper;
use App\Models\User;
use App\Models\Work;
use App\Models\Orders;
use App\Rules\isPremium;
use App\Rules\spaceCheck;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Foundation\Application;
use function auth;

class CustomerController extends Controller
{
    /**
     * Customer's wallet last statistics
     *
     * @return Application|Factory|View
     */
    public function customerWallet()
    {
        $transactions = auth()->user()->transactions()->where('type', '!=', 'upgrade expense')->latest()->paginate(10);
        $transactionsCollection = collect(auth()->user()->transactions);
        $balance_income = $transactionsCollection->whereIn('type', ['referral', 'work', 'rank', 'generation', 'incentive i-Balance', 'received balance'])->sum('amount');
        $balance_expense = $transactionsCollection->whereIn('type', ['withdraw', 'send money', 'income expense'])->sum('amount');
        $point_income = $transactionsCollection->whereIn('type', ['verification reward', 'product reward', 'purchase reward', 'received point', 'incentive e-Balance', 'received point'])->sum('amount');
        $point_expense = $transactionsCollection->whereIn('type', ['shop expense'])->sum('amount');
        $shop_wallet = auth()->user()->point;
        $income_balance = auth()->user()->balance;
        return view('web.pages.user.wallet', compact('point_income', 'point_expense', 'balance_expense', 'transactions', 'income_balance', 'shop_wallet', 'balance_income'));
    }

    /**
     * Create withdraw request
     *
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function customerWithdraw(Request $request): RedirectResponse
    {
        $request->validate([
            'payment_number'      => "required|string",
            'payment_method_type' => "required|boolean",
            'payment_method'      => 'required|in:bkash,nagad,rocket',
            'amount'              => 'required|integer',
            'password'            => 'required|password',
            'note'                => 'nullable|string',
        ]);
        if (auth()->user()->balance < $request->amount) return redirect()->back()->with('error', __('crud.withdraw.less_balance'))->withInput();
        if ($request->amount < 300) return redirect()->back()->with('error', __('crud.withdraw.minimum'))->withInput();
        $type = $request->payment_method_type ? "agent" : "personal";
        DB::beginTransaction();
        try {
            auth()->user()->transactions()->create([
                'user_id' => auth()->user()->id,
                'type'    => 'withdraw',
                'status'  => 0,
                'amount'  => $request->amount,
                'note'    => "<li>Requested for withdraw. Payment method: $request->payment_number ( $request->payment_method $type )</li><li> Note: $request->note </li>",
            ]);
            auth()->user()->decrement('balance', $request->amount);
            DB::commit();
            return redirect()->route('b2e.wallet')->with('success', "Requested successfully!");
        } catch (Throwable $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * User to user balance transfer
     *
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function customerSendMoney(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'exists:users'],
            'amount'   => ['required', 'integer'],
            'note'     => ['nullable', 'string'],
        ]);

        if (auth()->user()->balance < $request->amount) return redirect()->back()->with('error', __('crud.withdraw.less_balance'));
        if ($request->amount < 300) return redirect()->back()->with('error', __('crud.withdraw.minimum'));

        DB::beginTransaction();
        try {

            $receiver = User::query()->whereUsername($request->username);
            auth()->user()->transactions()->create([
                'type'   => 'send money',
                'amount' => $request->amount,
                'note'   => $request->note ?? __('bonus.balance.send_money', ['user' => $receiver->first()->username]),
                'status' => 1,
            ]);
            auth()->user()->decrement('balance', $request->amount);
            $receiver->first()->increment('balance', $request->amount);
            $receiver->first()->transactions()->create([
                'type'   => 'received balance',
                'amount' => $request->amount,
                'note'   => $request->note ?? __('bonus.balance.receive_money', ['user' => auth()->user()->username]),
                'status' => 1,
            ]);
            DB::commit();
            return redirect()->route('b2e.wallet')->with('success', "Done!");
        } catch (Throwable $exception) {
            DB::rollBack();
            return back()->with('error', $exception->getMessage());
        }
    }


    /**
     * Show user available works
     *
     * @return Application|Factory|View
     */
    public function customerWorks()
    {
        $work_id = auth()->user()->transactions()->whereNotNull('work_id')->pluck('work_id');
        $works = Work::select(['id', 'url', 'type', 'duration', 'file', 'notes'])->whereStatus(1)->whereNotIn('id', $work_id)->get();
        return view('web.pages.user.works', compact('works'));
    }

    /**
     * Pay user for work
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function submitCustomerWork(Request $request): JsonResponse
    {
        $work = Work::find($request->id);
        if (auth()->user()->transactions()->where('work_id', $request->id)->whereDate('created_at', now())->count()) return response()->json(['message' => 'Already added!']);
        DB::beginTransaction();
        try {
            auth()->user()->transactions()->create([
                'type'    => 'work',
                'amount'  => $work->price,
                'work_id' => $work->id,
                'note'    => __('bonus.balance.work'),
            ]);
            auth()->user()->increment('balance', $work->price);
            DB::commit();
            return response()->json(['message' => 'Work balance added!']);
        } catch (Throwable $throwable) {
            DB::rollBack();
            return response()->json(['message' => $throwable->getMessage()]);
        }
    }

    /**
     * Create user upgrade request for admin approval
     *
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function customerUpgrade(Request $request): RedirectResponse
    {
        $request->validate([
            "phone"         => "required|unique:users",
            "referral_user" => ['required', 'exists:users,username', new isPremium()],
            "sender_number" => "required|string",
            "trx"           => "required|string",
            "shipping"      => "required|string",
            "avatar"        => 'required|image',
            "nid1"          => 'required|image',
            "nid2"          => 'required|image',
            "nid"           => 'required|unique:users',
        ]);
        if (auth()->user()->user_type == 'regular' && auth()->user()->is_pending) return redirect()->back()->with('error', "Your previous request is pending.");
        $data = [
            "phone"         => $request->phone,
            "nid"           => $request->nid,
            "referral_user" => strtolower($request->referral_user),
            "shipping"      => $request->shipping,
            "is_pending"    => 1,

        ];
        if ($request->hasFile('avatar')) {
            if (auth()->user()->avatar) Storage::delete(auth()->user()->avatar);
            $data['avatar'] = $request->file('avatar')->store('users');
        }
        if ($request->hasFile('nid1')) {
            if (auth()->user()->nid1) Storage::delete(auth()->user()->nid1);
            $data['nid1'] = $request->file('nid1')->store('users');
        }
        if ($request->hasFile('nid2')) {
            if (auth()->user()->nid1) Storage::delete(auth()->user()->nid1);
            $data['nid2'] = $request->file('nid2')->store('users');
        }
        DB::beginTransaction();
        try {
            auth()->user()->update($data);
            auth()->user()->transactions()->create([
                'type'   => 'upgrade expense',
                'amount' => 1100,
                'note'   => "<li><strong>TRX</strong>: $request->trx </li> <li><strong>Number</strong>: $request->sender_number </li>",
            ]);
            DB::commit();
            return redirect()->route('profile')->with('success', "Successfully Requested!");
        } catch (QueryException $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Save child account request and make it pending for admin approval
     *
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function save_child(Request $request): RedirectResponse
    {
        $request->validate([
            "referral_user" => ['nullable', 'exists:users,username', new isPremium()],
            "sender_number" => "required|string",
            "trx"           => "required|string",
            "username"      => ['required', 'unique:users,username', new spaceCheck()],
        ]);

        DB::beginTransaction();
        try {
            $child = new User();
            $child->parent_id = auth()->user()->id;
            $child->user_type = 'regular';
            $child->name = auth()->user()->name;
            $child->username = strtolower($request->username);
            $child->email = auth()->user()->email;
            $child->avatar = auth()->user()->avatar;
            $child->referral_user = $request->referral_user ?? auth()->user()->username;
            $child->password = auth()->user()->password;
            $child->nid1 = auth()->user()->nid1;
            $child->nid2 = auth()->user()->nid2;
            $child->is_pending = 1;
            $child->save();
            $child->transactions()->create(['type' => 'upgrade expense', 'amount' => 1100, 'note' => "<strong>TRX</strong>:$request->trx <br/> <strong>Number</strong>: $request->sender_number"]);
            DB::commit();
            return redirect()->route('b2e.my-accounts')->with('success', "Successfully Requested!");
        } catch (QueryException $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Count all customer income
     *
     * @return Application|Factory|View
     */
    public function customerIncome()
    {
        $transactionsCollection = collect(auth()->user()->transactions);
        $balance_income = $transactionsCollection->whereIn('type', ['referral', 'work', 'rank', 'generation', 'incentive i-Balance', 'received balance'])->sum('amount');
        $referral_income = $transactionsCollection->where('type', 'referral')->sum('amount');
        $work_income = $transactionsCollection->where('type', 'work')->sum('amount');
        $rank_income = $transactionsCollection->where('type', 'rank')->sum('amount');
        $generation_income = $transactionsCollection->where('type', 'generation')->sum('amount');
        $incentive_income = $transactionsCollection->where('type', 'incentive i-Balance')->sum('amount');
        $received_balance = $transactionsCollection->where('type', 'received balance')->sum('amount');
        $balance_expense = $transactionsCollection->whereIn('type', ['withdraw', 'send money', 'income expense'])->sum('amount');
        $withdraw_expense = $transactionsCollection->where('type', 'withdraw')->sum('amount');
        $send_expense = $transactionsCollection->where('type', 'send money')->sum('amount');
        $income_expense = $transactionsCollection->where('type', 'income expense')->sum('amount');
        return \view('web.pages.user.income-balance-statement', compact(
            'balance_income',
            'referral_income',
            'work_income',
            'rank_income',
            'generation_income',
            'incentive_income',
            'balance_expense',
            'withdraw_expense',
            'send_expense',
            'income_expense',
            'received_balance'
        ));
    }

    /**
     * Count customers all points
     *
     * @return Application|Factory|View
     */
    public function customerPoint()
    {
        $transactionsCollection = collect(auth()->user()->transactions);
        $point_income = $transactionsCollection->whereIn('type', ['verification reward', 'product reward', 'purchase reward', 'received point', 'incentive e-Balance'])->sum('amount');
        $verification_income = $transactionsCollection->where('type', 'verification reward')->sum('amount');
        $product_income = $transactionsCollection->where('type', 'product reward')->sum('amount');
        $purchase_income = $transactionsCollection->where('type', 'purchase reward')->sum('amount');
        $received_balance = $transactionsCollection->where('type', 'received point')->sum('amount');
        $incentive_balance = $transactionsCollection->where('type', 'incentive e-Balance')->sum('amount');
        $point_expense = $transactionsCollection->whereIn('type', ['shop expense'])->sum('amount');
        $purchase_expense = $transactionsCollection->where('type', 'shop expense')->sum('amount');
        return \view('web.pages.user.shop-balance-statement', compact(
            'point_income',
            'verification_income',
            'product_income',
            'purchase_income',
            'point_expense',
            'purchase_expense',
            'received_balance',
            'incentive_balance'
        ));
    }

    /**
     * show all member of customers
     *
     * @return Application|Factory|View
     */
    public function customerTeams()
    {

        $generation = Helper::generateLevel();
        return \view('web.pages.user.my-teams', compact('generation'));
    }

    /**
     * Transfer requested amount from i-balance to e-wallet
     *
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function customerExchangeMoney(Request $request): RedirectResponse
    {
        $request->validate([
            "amount" => "required",
        ]);

        if (auth()->user()->balance < $request->amount) return redirect()->back()->with('error', __('crud.withdraw.less_balance'));
        if ($request->amount < 300) return redirect()->back()->with('error', "Minimum limit 300/-");

        DB::beginTransaction();
        try {
            auth()->user()->decrement('balance', $request->amount);
            auth()->user()->increment('point', $request->amount);
            auth()->user()->transactions()->create([
                'type'   => 'send money',
                'amount' => $request->amount,
                'note'   => "Send to E-Balance",
            ]);
            auth()->user()->transactions()->create([
                'type'   => 'received point',
                'amount' => $request->amount,
                'note'   => "Received from I-Balance",
            ]);
            DB::commit();
            return redirect()->route('b2e.wallet')->with('success', "Done!");
        } catch (QueryException $queryException) {
            DB::rollBack();
            return redirect()->back()->with('error', $queryException->getMessage())->withInput();
        }
    }

    /**
     * Show all order details
     *
     * @param Request $request
     *
     * @return Application|Factory|View
     */
    public function showOrderDetails(Request $request)
    {
        $order = Orders::with('allOrderDetails')->find(decrypt($request->id));
        return \view('web.pages.user.my-order-details', compact('order'));
    }
}
