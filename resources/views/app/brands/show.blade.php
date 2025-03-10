@extends('layouts.app')
@section('title') {{__('crud.brands.index_title')}} @endsection
@section('section-title') {{__('crud.brands.index_title')}} @endsection
@section('section-content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('brands.index') }}" class="mr-4"
                    ><i class="icon fas fa-arrow-back"></i
                ></a>
                @lang('crud.brands.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.brands.inputs.name')</h5>
                    <span>{{ $brand->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.brands.inputs.slug')</h5>
                    <span>{{ $brand->slug ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.brands.inputs.logo')</h5>
                    <x-partials.thumbnail
                        src="{{ $brand->logo ? asset($brand->logo) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.brands.inputs.status')</h5>
                    <span>{{ $brand->status ? "Active" : "Inactive" }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('brands.index') }}" class="btn btn-light">
                    <i class="icon fas fa-arrow-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Brand::class)
                <a href="{{ route('brands.create') }}" class="btn btn-light">
                    <i class="icon fas fa-plus"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
