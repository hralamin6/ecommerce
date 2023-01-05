<?php

    namespace App\Http\Controllers;


    use App\Helper;
    use App\Models\Coupons;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Contracts\View\View;
    use Illuminate\Contracts\View\Factory;
    use App\Http\Requests\CouponsStoreRequest;
    use App\Http\Requests\CouponsUpdateRequest;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Auth\Access\AuthorizationException;

    class CouponsController extends Controller
    {
        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function index(Request $request)
        {
            $this->authorize('view-any', Coupons::class);

            $search = $request->get('search', '');

            $allCoupons = Coupons::when($search, function ($query) use ($search) {
                    $query->search($search);
                })
                ->latest()
                ->paginate(15);

            return view('app.all_coupons.index', compact('allCoupons', 'search'));
        }

        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function create(Request $request)
        {
            $this->authorize('create', Coupons::class);

            return view('app.all_coupons.create');
        }

        /**
         * @param CouponsStoreRequest $request
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function store(CouponsStoreRequest $request)
        {
            $this->authorize('create', Coupons::class);

            $validated = $request->validated();

            $coupons = Coupons::create($validated);

            return redirect()
                ->route('all-coupons.edit', $coupons)
                ->withSuccess(__('crud.common.created'));
        }

        /**
         * @param Request $request
         * @param Coupons $coupons
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function show(Request $request, Coupons $coupons)
        {
            $this->authorize('view', $coupons);

            return view('app.all_coupons.show', compact('coupons'));
        }

        /**
         * @param Request $request
         * @param Coupons $coupons
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function edit(Request $request, Coupons $coupons)
        {
            $this->authorize('update', $coupons);

            return view('app.all_coupons.edit', compact('coupons'));
        }

        /**
         * @param CouponsUpdateRequest $request
         * @param Coupons              $coupons
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function update(CouponsUpdateRequest $request, Coupons $coupons)
        {
            $this->authorize('update', $coupons);

            $validated = $request->validated();

            $coupons->update($validated);

            return redirect()
                ->route('all-coupons.edit', $coupons)
                ->withSuccess(__('crud.common.saved'));
        }

        /**
         * @param Request $request
         * @param Coupons $coupons
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function destroy(Request $request, Coupons $coupons)
        {
            $this->authorize('delete', $coupons);

            $coupons->delete();

            return redirect()
                ->route('all-coupons.index')
                ->withSuccess(__('crud.common.removed'));
        }

        public function apply(Request $request)
        {
            $this->validate($request, [
                'code' => "required|exists:coupons",
            ], ['required' => "Coupon is required", 'exists' => 'Coupon is invalid!']);
            $coupon = Coupons::query()
                ->where('code', $request->code)
                ->where('end', '>=', now())
                ->where('start', '<=', now())
                ->first();
            if ($coupon != null) {
                $sum = Helper::getCartTotal()['total'];
                $couponDiscount = $coupon->discount_type == 'percent' ? ($sum * $coupon->discount) / 100 : $coupon->discount;
                $totalDiscount = $sum - (double)$couponDiscount;
                $request->session()->has('coupon_discount') ? $request->session()->forget('coupon_discount') : '';
                $request->session()->put('coupon_discount', $totalDiscount);
                return response()->json([
                    'message'  => "Coupon applied!",
                    'total'    => $sum,
                    'discount' => round($totalDiscount, 0, PHP_ROUND_HALF_UP),
                ], Response::HTTP_OK);

            } else {
                return response()->json(['message' => "Please check coupon code"], Response::HTTP_NOT_FOUND);
            }
        }
    }
