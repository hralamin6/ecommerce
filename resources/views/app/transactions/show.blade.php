@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('transactions.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.transactions.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.transactions.inputs.user_id')</h5>
                    <span>{{ optional($transection->user)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.transactions.inputs.work_id')</h5>
                    <span>{{ optional($transection->work)->url ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.transactions.inputs.amount')</h5>
                    <span>{{ $transection->amount ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.transactions.inputs.note')</h5>
                    <span>{{ $transection->note ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('transactions.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Transection::class)
                <a
                    href="{{ route('transactions.create') }}"
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
