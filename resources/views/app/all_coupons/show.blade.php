@extends('layouts.app')
@section('title') {{__('crud.all_coupons.index_title')}} @endsection
@section('section-title') {{$coupons->code}} @endsection
@section('section-content')
    <div class="container">
        <div class="card">
            <div class="card-body">

                <div class="mt-4">
                    <div class="mb-4">
                        <p><strong>@lang('crud.all_coupons.inputs.discount')</strong>:
                            <span>{{ $coupons->discount ?? '-' }}</span></p>
                    </div>
                    <div class="mb-4">
                        <p><strong>@lang('crud.all_coupons.inputs.discount_type')</strong>:
                            <span>{{ $coupons->discount_type ?? '-' }}</span></p>
                    </div>
                    <div class="mb-4">
                        <p><strong>@lang('crud.all_coupons.inputs.start')</strong>:
                            <span>{{ $coupons->start ?? '-' }}</span></p>
                    </div>
                    <div class="mb-4">
                        <p><strong>@lang('crud.all_coupons.inputs.end')</strong>:
                            <span>{{ $coupons->end ?? '-' }}</span></p>
                    </div>
                </div>

                <div class="mt-4">
                    <a
                            href="{{ route('all-coupons.index') }}"
                            class="btn btn-light"
                    >
                        <i class="icon fas fa-arrow-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Coupons::class)
                        <a
                                href="{{ route('all-coupons.create') }}"
                                class="btn btn-light"
                        >
                            <i class="icon fas fa-plus"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
