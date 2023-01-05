@extends('web.layouts.layout')
@php
$feature_products = \App\Models\Products::query()->latest()->where('status', 1)->limit(8)->get();
@endphp
@section('content')
<div class="page-content-wrapper">
  <div class="page-content-wrapper">
    <!-- Top Products-->
    <div class="top-products-area py-3">
      <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
          <h6>Featured Products</h6>
        </div>
        <div class="row g-3">
          <!-- Featured Product Card-->
          @each('components.frontend.product.top_product', $feature_products, 'item')
        </div>
      </div>
    </div>
  </div>

</div>
@endsection