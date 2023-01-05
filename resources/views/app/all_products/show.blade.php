@extends('layouts.app')
@section('title') {{__('crud.all_products.show_title')}} @endsection
@section('section-title') {{__('crud.all_products.show_title')}} @endsection
@push('stylesheet')
<script type="text/javascript" src="{{ asset('lib/js/chocolat.js') }}">
</script>
<link rel="stylesheet" href="{{ asset('lib/css/chocolat.css') }}"
    type="text/css" media="screen">
@endpush
@section('section-content')
<div class="container">
    <div class="card">

        <img src="{{ $products->thumbnail_img ? asset($products->thumbnail_img) : '' }}"
            alt="{{ $products->name }}" class="mx-auto w-25">
      
            <div class="chocolat-parent container">
                @foreach(json_decode($products->gallery) as $image)
                <a class="chocolat-image" href="{{  asset($image) }}" title="caption image 2">
                    <img width="100" src="{{  asset($image) }}" />
                </a>
                @endforeach
            </div>
        
  

    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 ">
                <strong>@lang('crud.all_products.inputs.category_id')</strong>:
                <span>{{ optional($products->category)->name ?? '-' }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 ">
                <strong>@lang('crud.all_products.inputs.name')</strong>
                <span>{{ $products->name ?? '-' }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 ">
                <strong>@lang('crud.all_products.inputs.description')</strong>
                <span>{{ $products->description ?? '-' }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 ">
                <strong>@lang('crud.all_products.inputs.sale_price')</strong>
                <span>{{ $products->sale_price ?? '-' }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 ">
                <strong>@lang('crud.all_products.inputs.purchase_price')</strong>
                <span>{{ $products->purchase_price ?? '-' }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 ">
                <strong>@lang('crud.all_products.inputs.status')</strong>
                <span>{{ $products->status ? "Active" : "Inactive" }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 ">
                <strong>@lang('crud.all_products.inputs.is_flash')</strong>
                <span>{{ $products->is_flash ? 'Yes' : 'No' }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 ">
                <strong>@lang('crud.all_products.inputs.is_feature')</strong>
                <span>{{ $products->is_feature ? 'Yes' : 'No' }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 ">
                <strong>@lang('crud.all_products.inputs.discount')</strong>
                <span>{{ $products->discount ?? '-' }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 ">
                <strong>@lang('crud.all_products.inputs.discount_type')</strong>
                <span>{{ $products->discount_type ?? '-' }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 ">
                <strong>@lang('crud.all_products.inputs.stock')</strong>
                <span>{{ $products->stock ?? '-' }}</span>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('all-products.index') }}" class="btn btn-light">
                <i class="icon fas fa-arrow-left"></i>
                @lang('crud.common.back')
            </a>

            @can('create', App\Models\Products::class)
            <a href="{{ route('all-products.create') }}" class="btn btn-light">
                <i class="icon fas fa-plus"></i> @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </div>
</div>
</div>
@endsection
@push('javascript')
<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
    Chocolat(document.querySelectorAll('.chocolat-parent .chocolat-image'))
})
</script>
@endpush