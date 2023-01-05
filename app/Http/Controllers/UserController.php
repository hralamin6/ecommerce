<?php

namespace App\Http\Controllers;

use Throwable;
use App\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\DataTables\UsersDataTable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Auth\Access\AuthorizationException;

class UserController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function index(UsersDataTable $dataTable)
    {
        $this->authorize('view-any', User::class);
        return $dataTable->render('app.users.index');
        //            $search = $request->get('search', '');
        //
        //            $users = User::query()
        //                ->when($search, function ($query) use ($search) {
        //                    $query->search($search);
        //                })
        //                ->latest()
        //                ->paginate(15);
        //
        //            return view('app.users.index', compact('users', 'search'));
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create(Request $request)
    {
        $this->authorize('create', User::class);

        $roles = Role::get();

        return view('app.users.create', compact('roles'));
    }

    /**
     * @param UserStoreRequest $request
     *
     * @return Response
     * @throws AuthorizationException
     */
    public function store(UserStoreRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('users');
        }

        $user = User::create($validated);

        $user->syncRoles($request->roles);

        return redirect()
            ->route('users.edit', $user)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param Request $request
     * @param User    $user
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function show(Request $request, User $user)
    {
        $this->authorize('view', $user);

        return view('app.users.show', compact('user'));
    }

    /**
     * @param Request $request
     * @param User    $user
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $roles = Role::get();

        return view('app.users.edit', compact('user', 'roles'));
    }

    /**
     * @param UserUpdateRequest $request
     * @param User              $user
     *
     * @return Response
     * @throws AuthorizationException
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }

            $validated['avatar'] = $request->file('avatar')->store('users');
        }

        $user->update($validated);

        //            $user->syncRoles($request->roles);

        return redirect()
            ->route('users.edit', $user)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param Request $request
     * @param User    $user
     *
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Request $request, User $user)
    {
        $this->authorize('delete', $user);

        if ($user->avatar) {
            Storage::delete($user->avatar);
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->withSuccess(__('crud.common.removed'));
    }

    /**
     * Update user profile from shop
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function updateUser(Request $request)
    {

        $profile = [
            "shipping" => $request->shipping,
        ];
        if (isset($request->password)) $profile['password'] = Hash::make($request->password);

        if ($request->hasFile('avatar')) {
            if (auth()->user()->avatar) {
                Storage::delete(auth()->user()->avatar);
            }

            $profile['avatar'] = $request->file('avatar')->store('users');
        }

        auth()->user()->update($profile);

        return redirect()
            ->back()
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * List of pending upgrade user
     *
     */
    public function pending_upgrade(Request $request)
    {
        $this->authorize('view-any', User::class);

        $search = $request->get('search', '');

        $users = User::query()
            ->where('is_pending', 1)
            ->when($search, function ($query) use ($search) {
                $query->search($search);
            })
            ->latest()
            ->paginate(15);

        return view('app.users.upgrade.index', compact('users', 'search'));
    }

    /**
     * Show individual user
     *
     * @param Request $request
     * @param User    $user
     *
     * @return Application|Factory|View
     */
    public function show_upgrade(Request $request, User $user)
    {
        $transactions = $user->transactions()->where('type', 'upgrade expense')->first();
        return view('app.users.upgrade.show', compact('user', 'transactions'));
    }

    /**
     * Approve selective user
     *
     * @param Request $request
     * @param User    $user
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function approve_upgrade(Request $request, User $user): JsonResponse
    {
        if ($user->is_accepted) return response()->json(['message' => 'Already premium!']);
        DB::beginTransaction();
        try {
            $user->update([
                'user_type'   => 'premium',
                'is_pending'  => 0,
                'is_accepted' => 1,
                'point'       => 700,
                'expired_at'  => now()->addYear(),
            ]);
            $user->transactions()->create([
                'type'   => 'verification reward',
                'amount' => 700,
                'note'   => __('bonus.shop.verification_reward'),
            ]);
            $referral = User::query()->where('username', $user->referral_user)->first();
            $referral->increment('balance', 100);
            $referral->transactions()->create([
                'type'   => 'referral',
                'amount' => 100,
                'note'   => __('bonus.balance.referral', ['user' => $user->username]),
            ]);
            Helper::generationBonus($user, 10, __('bonus.balance.generation', ['user' => $user->username]), 'generation', 'balance');
            DB::commit();
            return response()->json(['message' => 'Approved!']);
        } catch (Throwable $throwable) {
            DB::rollBack();
            return response()->json(['message' => $throwable->getMessage()]);
        }
    }

    /**
     * Cancel upgrade request
     *
     * @param Request $request
     * @param User    $user
     *
     * @return JsonResponse
     */
    public function cancel_upgrade(Request $request, User $user): JsonResponse
    {
        DB::beginTransaction();
        try {
            $user->update(['is_pending' => 0, 'phone' => null, 'nid' => null]);
            $user->transactions()->where('type', 'upgrade expense')->latest()->delete();
            DB::commit();
            return response()->json(['message' => 'Canceled!']);
        } catch (QueryException $queryException) {
            DB::rollBack();
            return response()->json(['message' => $queryException->getMessage()]);
        }
    }

    /**
     * Login into child account
     *
     * @param Request $request
     * @param User    $user
     *
     * @return RedirectResponse
     */
    public function login_child(Request $request, User $user): RedirectResponse
    {
        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->intended(route('b2e.profile'));
    }
}
