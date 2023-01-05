<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\PaymentMethod;
    use Illuminate\Http\Response;
    use Illuminate\Contracts\View\View;
    use Illuminate\Contracts\View\Factory;
    use App\Http\Requests\PaymentMethodStoreRequest;
    use Illuminate\Contracts\Foundation\Application;
    use App\Http\Requests\PaymentMethodUpdateRequest;
    use Illuminate\Auth\Access\AuthorizationException;

    class PaymentMethodController extends Controller
    {
        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function index(Request $request)
        {
            $this->authorize('view-any', PaymentMethod::class);

            $search = $request->get('search', '');

            $paymentMethods = PaymentMethod::
            when($search, function ($query) use ($search) {
                $query->search($search);
            })
                ->latest()
                ->paginate(20);

            return view(
                'app.payment_methods.index',
                compact('paymentMethods', 'search')
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
            $this->authorize('create', PaymentMethod::class);

            return view('app.payment_methods.create');
        }

        /**
         * @param PaymentMethodStoreRequest $request
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function store(PaymentMethodStoreRequest $request)
        {
            $this->authorize('create', PaymentMethod::class);

            $validated = $request->validated();

            $paymentMethod = PaymentMethod::create($validated);

            return redirect()
                ->back()
                ->withSuccess(__('crud.common.created'));
        }

        /**
         * @param Request       $request
         * @param PaymentMethod $paymentMethod
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function show(Request $request, PaymentMethod $paymentMethod)
        {
            $this->authorize('view', $paymentMethod);

            return view('app.payment_methods.show', compact('paymentMethod'));
        }

        /**
         * @param Request       $request
         * @param PaymentMethod $paymentMethod
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function edit(Request $request, PaymentMethod $paymentMethod)
        {
            $this->authorize('update', $paymentMethod);

            return view('app.payment_methods.edit', compact('paymentMethod'));
        }

        /**
         * @param PaymentMethodUpdateRequest $request
         * @param PaymentMethod              $paymentMethod
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function update(
            PaymentMethodUpdateRequest $request,
            PaymentMethod $paymentMethod
        )
        {
            $this->authorize('update', $paymentMethod);

            $validated = $request->validated();

            $paymentMethod->update($validated);

            return redirect()
                ->route('payment-methods.edit', $paymentMethod)
                ->withSuccess(__('crud.common.saved'));
        }

        /**
         * @param Request       $request
         * @param PaymentMethod $paymentMethod
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function destroy(Request $request, PaymentMethod $paymentMethod)
        {
            $this->authorize('delete', $paymentMethod);

            $paymentMethod->delete();

            return redirect()
                ->route('payment-methods.index')
                ->withSuccess(__('crud.common.removed'));
        }
    }
