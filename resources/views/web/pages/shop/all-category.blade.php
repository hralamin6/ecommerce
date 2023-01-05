@extends('web.layouts.layout')
@section('content')
<div>
    <!-- Product Catagories-->
    <div class="product-catagories-wrapper py-3">
        <div class="container">
            <div class="section-heading d-flex align-items-center justify-content-between">
                <h6>Product Categories</h6>
            </div>
            <div class="product-catagory-wrap">
                <div class="g-3  justify-content-center row">
                    @each('components.frontend.category.ctacard', $categories, 'item', 'partials.no-item')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection