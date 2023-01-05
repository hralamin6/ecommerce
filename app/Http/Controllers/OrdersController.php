<?php

    namespace App\Http\Controllers;

    use App\Helper;
    use App\Models\User;
    use App\Models\Orders;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Contracts\View\View;
    use Illuminate\Contracts\View\Factory;
    use App\Http\Requests\OrdersStoreRequest;
    use App\Http\Requests\OrdersUpdateRequest;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Auth\Access\AuthorizationException;

    class OrdersController extends Controller
    {
        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function index(Request $request)
        {
            $this->authorize('view-any', Orders::class);

            $search = $request->get('search', '');

            $allOrders = Orders::query()
                ->when($search, function ($query) use ($search) {
                    $query->search($search);
                })
                ->with('user:id,name')
                ->latest()
                ->paginate(15);

            return view('app.all_orders.index', compact('allOrders', 'search'));
        }

        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function create(Request $request)
        {
            $this->authorize('create', Orders::class);

            $users = User::pluck('name', 'id');

            return view('app.all_orders.create', compact('users'));
        }

        /**
         * @param OrdersStoreRequest $request
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function store(OrdersStoreRequest $request)
        {
            $this->authorize('create', Orders::class);

            $validated = $request->validated();

            $orders = Orders::create($validated);

            return redirect()
                ->route('all-orders.edit', $orders)
                ->withSuccess(__('crud.common.created'));
        }

        /**
         * @param Request $request
         * @param Orders  $orders
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function show(Request $request, Orders $orders)
        {
            $this->authorize('view', $orders);
            return view('app.all_orders.show', compact('orders'));
        }

        /**
         * @param Request $request
         * @param Orders  $orders
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function edit(Request $request, Orders $orders)
        {
            $this->authorize('update', $orders);

            $users = User::pluck('name', 'id');

            return view('app.all_orders.edit', compact('orders', 'users'));

        }

        /**
         * @param OrdersUpdateRequest $request
         * @param Orders              $orders
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function update(Request $request, Orders $orders)
        {

            $this->authorize('update', $orders);

            $validated = $request->except('_token');

            if (isset($validated['payment_status']) && $validated['payment_status'] == "paid") {
                if (auth()->user()->isPremium() || auth()->user()->isAdmin()) {
                    Helper::giveBonusToUsers($orders);
                }
            }
            $orders->update($validated);

            return redirect()
                ->route('all-orders.edit', $orders)
                ->withSuccess(__('crud.common.saved'));
        }

        /**
         * @param Request $request
         * @param Orders  $orders
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function destroy(Request $request, Orders $orders)
        {
            $this->authorize('delete', $orders);

            $orders->delete();

            return redirect()
                ->route('all-orders.index')
                ->withSuccess(__('crud.common.removed'));
        }
    }
