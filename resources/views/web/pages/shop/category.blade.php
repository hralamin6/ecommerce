@extends('web.layouts.layout')
@section('content')
<div class="page-content-wrapper">
    <!-- Catagory Single Image-->
    <div class="pt-3">
        <div class="container">
            <div class="catagory-single-img pt-3"
                style="background-image: url({{asset($category->banner)}});background-repeat: no-repeat;">
            </div>
        </div>
    </div>
    <!-- Product Catagories-->
    @if(count( $category->sub_categories) > 0 )
    <div class="product-catagories-wrapper py-3">
        <div class="container">
            <div class="section-heading">
                <h6>Sub Category</h6>
            </div>
            <div class="product-catagory-wrap">
                <div class="row g-3">
                    @each('partials.single-category', $category->sub_categories, 'item')
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Top Products-->
    <div class="top-products-area pb-3 mt-4">
        <div class="container">
            <div class="section-heading d-flex align-items-center justify-content-between">
                <h6>Catagory Products</h6>
            </div>
            <div class="row g-3">
                @each('components.frontend.product.top_product', $category->allProducts, 'item')
            </div>
        </div>
    </div>
</div>
@endsection