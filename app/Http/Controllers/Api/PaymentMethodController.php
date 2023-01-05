<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMethodResource;
use App\Http\Resources\PaymentMethodCollection;
use App\Http\Requests\PaymentMethodStoreRequest;
use App\Http\Requests\PaymentMethodUpdateRequest;

class PaymentMethodController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', PaymentMethod::class);

        $search = $request->get('search', '');

        $paymentMethods = PaymentMethod::search($search)
            ->latest()
            ->paginate();

        return new PaymentMethodCollection($paymentMethods);
    }

    /**
     * @param \App\Http\Requests\PaymentMethodStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentMethodStoreRequest $request)
    {
        $this->authorize('create', PaymentMethod::class);

        $validated = $request->validated();

        $paymentMethod = PaymentMethod::create($validated);

        return new PaymentMethodResource($paymentMethod);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PaymentMethod $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PaymentMethod $paymentMethod)
    {
        $this->authorize('view', $paymentMethod);

        return new PaymentMethodResource($paymentMethod);
    }

    /**
     * @param \App\Http\Requests\PaymentMethodUpdateRequest $request
     * @param \App\Models\PaymentMethod $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(
        PaymentMethodUpdateRequest $request,
        PaymentMethod $paymentMethod
    ) {
        $this->authorize('update', $paymentMethod);

        $validated = $request->validated();

        $paymentMethod->update($validated);

        return new PaymentMethodResource($paymentMethod);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PaymentMethod $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PaymentMethod $paymentMethod)
    {
        $this->authorize('delete', $paymentMethod);

        $paymentMethod->delete();

        return response()->noContent();
    }
}
