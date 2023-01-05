<?php

    namespace App\Http\Controllers;

    use Throwable;
    use App\Models\User;
    use App\Models\Work;
    use App\Models\Transaction;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Contracts\View\Factory;
    use App\Http\Requests\TransactionStoreRequest;
    use App\Http\Requests\TransactionUpdateRequest;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Auth\Access\AuthorizationException;

    class TransactionController extends Controller
    {
        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function index(Request $request)
        {
            $this->authorize('view-any', Transaction::class);

            $search = $request->get('search', '');

            $transactions = Transaction::when($search, function ($query) use ($search) {
                    $query->search($search);
                })
                ->latest()
                ->paginate(5);

            return view(
                'app.transactions.index',
                compact('transactions', 'search')
            );
        }

        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function create(Request $request)
        {
            $this->authorize('create', Transaction::class);

            $users = User::query()->pluck('name', 'id');
            $works = Work::query()->pluck('status', 'id');

            return view('app.transactions.create', compact('users', 'works'));
        }

        /**
         * @param TransactionStoreRequest $request
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function store(TransactionStoreRequest $request)
        {
            $this->authorize('create', Transaction::class);

            $validated = $request->validated();

            $transaction = Transaction::query()->create($validated);

            return redirect()
                ->route('transactions.edit', $transaction)
                ->withSuccess(__('crud.common.created'));
        }

        /**
         * @param Request     $request
         * @param Transaction $transaction
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function show(Request $request, Transaction $transaction)
        {
            $this->authorize('view', $transaction);

            return view('app.transactions.show', compact('transaction'));
        }

        /**
         * @param Request     $request
         * @param Transaction $transaction
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function edit(Request $request, Transaction $transaction)
        {
            $this->authorize('update', $transaction);

            $users = User::query()->pluck('name', 'id');
            $works = Work::query()->pluck('status', 'id');

            return view(
                'app.transactions.edit',
                compact('transaction', 'users', 'works')
            );
        }

        /**
         * @param TransactionUpdateRequest $request
         * @param Transaction              $transaction
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function update(
            TransactionUpdateRequest $request,
            Transaction $transaction
        )

        {
            $this->authorize('update', $transaction);

            $validated = $request->validated();

            $transaction->update($validated);

            return redirect()
                ->route('transactions.edit', $transaction)
                ->withSuccess(__('crud.common.saved'));
        }

        /**
         * @param Request     $request
         * @param Transaction $transaction
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function destroy(Request $request, Transaction $transaction)
        {
            $this->authorize('delete', $transaction);

            $transaction->delete();

            return redirect()
                ->route('transactions.index')
                ->withSuccess(__('crud.common.removed'));
        }

        /**
         * @throws \Throwable
         */
        public function sendPositionBonus(Request $request): RedirectResponse
        {
            $request->validate([
                'users' => ['required', 'string'],
                'amount'  => ['required', 'integer'],
                'note'    => ['nullable', 'string'],
            ]);
            $users = explode (',', $request->users);
            DB::beginTransaction();
            try {
                foreach ($users as $user){
                    $data = [
                        "user_id" => $user,
                        "amount"  => $request->amount,
                        "note"    => $request->note ?? __('bonus.balance.rank'),
                        "type"    => 'rank',
                    ];
                    User::query ()->find($user)->increment('point', $request->amount);
                    Transaction::query()->create($data);
                }

                DB::commit();
                return redirect()->back()->with('success', __('crud.common.created'));
            }
            catch (Throwable $exception) {
                DB::rollBack();
                return redirect()->back()->with('error', $exception->getMessage());
            }


        }public function sendIncentiveBonus(Request $request): RedirectResponse
        {
            $request->validate([
                'user_id' => ['required', 'exists:users,id'],
                'wallet'  => ['required', 'in:0,1'],
                'amount'  => ['required', 'integer'],
                'note'    => ['nullable', 'string'],
            ]);
            $data = [
                "user_id" => $request->user_id,
                "amount"  => $request->amount,
                "note"    => $request->note ?? __('bonus.balance.incentive'),
                "type"    => $request->wallet ? "incentive e-Balance" : "incentive i-Balance",
            ];
            DB::beginTransaction();
            try {
                $user = User::query()->find($request->user_id);
                /* 0 = Balance & 1 = e-wallet */
                $request->wallet ? $user->increment('point', $request->amount) : $user->increment('balance', $request->amount);
                Transaction::query()->create($data);
                DB::commit();
                return redirect()->back()->with('success', __('crud.common.created'));
            }
            catch (Throwable $exception) {
                DB::rollBack();
                return redirect()->back()->with('error', $exception->getMessage());
            }


        }


    }
