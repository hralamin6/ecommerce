@extends('web.layouts.layout')

@push('front-style')
<link rel="stylesheet" href="{{ asset('vendor/modallink/jquery.modalLink-1.0.0.css') }}">
<style>
    .min-vh-87{
        min-height: 87vh!important;
    }
</style>
@endpush
@section('content')

<!-- Product Catagories-->
<div class="product-catagories-wrapper py-3">
    <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6>Todays works</h6>
        </div>

        <div class="product-catagory-wrap">
            <div class="row g-3">
                <!-- Works list card-->
                @each('components.frontend.work-card', $works, 'item','partials.no-item')
            </div>
        </div>
    </div>
</div>

@endsection
