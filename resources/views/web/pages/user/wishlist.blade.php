@extends('web.layouts.layout')

@section('content')
<div class="page-content-wrapper">
    <!-- Top Products-->
    <div class="top-products-area py-3">
        <div class="container" id="wishlist-content">
            @include('web.partials.wishlist')
        </div>
    </div>
</div>
@endsection