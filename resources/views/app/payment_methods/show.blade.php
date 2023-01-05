@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('payment-methods.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.payment_methods.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.payment_methods.inputs.number')</h5>
                    <span>{{ $paymentMethod->number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.payment_methods.inputs.type')</h5>
                    <span>{{ $paymentMethod->type ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.payment_methods.inputs.status')</h5>
                    <span>{{ $paymentMethod->status ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('payment-methods.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\PaymentMethod::class)
                <a
                    href="{{ route('payment-methods.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
