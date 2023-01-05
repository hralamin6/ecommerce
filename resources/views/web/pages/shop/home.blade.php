@extends('web.layouts.layout')


@section('content')

    <div>
    @if($notice)
        <!-- Discount Coupon Card-->
            <div class="container pt-3">
                <div class="card bg-success  border-0">
                    <div class="card-body">
                        <div class="align-items-center coupon-text-wrap d-flex">
                            <p class="text-white text-center ps-3 mb-0">{{ $notice }}</p>
                        </div>
                    </div>
                </div>
            </div>
    @endif
    @if(session()->has('code'))
        <!-- Discount Coupon Card-->
            <div class="container pt-3" onload="closeOrder()">
                <div class="card bg-success  border-0">
                    <div class="card-body">
                        <div class="align-items-center coupon-text-wrap d-flex">
                            <p class="text-white text-center ps-3 mb-0">Thank you! Your order code is<strong
                                    class="px-1">{{ session()->get('code') }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(count($sliders))
            <div class="container">
                <div class="pt-3">
                    <!-- Hero Slides-->
                    <div class="hero-slides owl-carousel">
                        <!-- Single Hero Slide-->
                        @each('components.frontend.slide', $sliders, 'slider')
                    </div>
                </div>
            </div>
        @endif
        @if(count($categories))
        <!-- Product Catagories-->
            <div class="product-catagories-wrapper py-3">
                <div class="container">
                    <div class="section-heading d-flex align-items-center justify-content-between">
                        <h6>Product Categories</h6><a class="btn btn-success btn-sm"
                                                      href="{{ route('all.categories') }}">View
                            All</a>
                    </div>

                    <div class="product-catagory-wrap">
                        <div class="g-3  justify-content-center row">
                            <!-- Single Catagory Card-->
                            @each('components.frontend.category.ctacard', $categories, 'item')
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(count($flash_sale) && $show_flash)
        <!-- Flash Sale Slide-->
            <div class="flash-sale-wrapper">
                <div class="container">
                    <div class="section-heading d-flex align-items-center justify-content-between">
                        <h6 class="me-1 d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                 class="bi bi-lightning me-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09zM4.157 8.5H7a.5.5 0 0 1 .478.647L6.11 13.59l5.732-6.09H9a.5.5 0 0 1-.478-.647L9.89 2.41 4.157 8.5z"/>
                            </svg>
                            Flash sale
                        </h6>
                        <!-- Please use event time this format: YYYY/MM/DD hh:mm:ss-->
                        <x-frontend.countdown :time="Carbon\Carbon::parse($flash_end)->toDateTimeString()"/>
                    </div>
                    <!-- Flash Sale Slide-->
                    <div class="flash-sale-slide owl-carousel">
                        <!-- Single Flash Sale Card-->
                        @each('components.frontend.flashcard', $flash_sale, 'item')
                    </div>
                </div>
                <div class="container">
                    <!--.text-center.mt-3-->
                    <!--a.btn.btn-success.btn-sm(href="flash-sale.html") View All-->
                </div>
            </div>
        @endif
        @if(count($top_products))
        <!-- Top Products-->
            <div class="top-products-area clearfix py-3">
                <div class="container">
                    <div class="section-heading d-flex align-items-center justify-content-between">
                        <h6>Top Products</h6><a class="btn btn-success btn-sm" href="/all-products">View All</a>
                    </div>
                    <div class="row g-3">
                        <!-- Single Top Product Card-->
                        @each('components.frontend.product.top_product', $top_products, 'item')

                    </div>
                </div>
            </div>
        @endif
        @if(count($home_banner ) > 0 )
        <!-- Cool Facts Area-->
            <div class="cta-area">
                <div class="container">
                    <div class="cta-text p-4 p-lg-5"
                         style="background-image: url({{ (new \App\Helper())->getSliderImage($home_banner[0]->photo) }})">
                        <h4>{{ $home_banner[0]->title ?? ''}}</h4>
                        <p>{{ $home_banner[0]->sub_title ?? ''}}</p>
                        <a class="btn btn-danger" href="{{$home_banner[0]->url ?? url('/')}}">Shop Today</a>
                    </div>
                </div>
            </div>
        @endif
        @if(count($weeklySale))
        <!-- Weekly Best Sellers-->
            <div class="weekly-best-seller-area py-3">
                <div class="container">
                    <div class="section-heading d-flex align-items-center justify-content-between">
                        <h6>Weekly Best Sellers</h6><a class="btn btn-success btn-sm" href="/all-products">View All</a>
                    </div>
                    <div class="row g-3">
                        <!-- Single Weekly Product Card-->
                        @each('components.frontend.product.weekly', $weeklySale, 'item')
                    </div>
                </div>
            </div>
        @endif
        @if($coupon)
        <!-- Discount Coupon Card-->
            <div class="container">
                <div class="card discount-coupon-card border-0">
                    <div class="card-body">
                        <div class="coupon-text-wrap d-flex align-items-center p-3">
                            <h5 class="text-white pe-3 mb-0">Get
                                {{$coupon->discount}}{{$coupon->discount_type == 'amount' ? '/-': '%'}} <br> discount
                            </h5>
                            <p class="text-white ps-3 mb-0">To get discount, enter the<strong
                                    class="px-1">{{ $coupon->code }}</strong>code
                                on the checkout page.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(count($feature_products))
        <!-- Featured Products Wrapper-->
            <div class="featured-products-wrapper py-3">
                <div class="container">
                    <div class="section-heading d-flex align-items-center justify-content-between">
                        <h6>Featured Products</h6><a class="btn btn-success btn-sm" href="/featured-product">View
                            All</a>
                    </div>
                    <div class="row g-3">
                        @each('components.frontend.product.top_product', $feature_products, 'item')
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
