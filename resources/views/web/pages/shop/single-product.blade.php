@extends('web.layouts.layout')
@push('front-style')
    <link rel="stylesheet" href="{{ asset ('frontend/css/colors.css') }}">
@endpush
@section('content')
    <div class="page-content-wrapper">
        <div id="single-product-container">
            <!-- Product Slides-->
            <div class="product-slides owl-carousel">
                @if(isset($product->gallery) && !empty(json_decode($product->gallery)))
                    @foreach(json_decode($product->gallery) as $slide)
                        <div>
                            <div class="align-items-center d-flex justify-content-center single-product-slide">
                                <img class="single-product-img" src="{{ asset($slide) }}" alt="">
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="product-description pb-3">
                <!-- Product Title & Meta Data-->
                <div class="product-title-meta-data bg-white mb-3 py-3">
                    <div class="container d-flex justify-content-between">
                        <div class="p-title-price">
                            <h6 class="mb-1">{{ $product->name }}</h6>
                            <p class="sale-price mb-0">{!! \App\Helper::formatSinglePrice ($product->sale_price,
                            $product->discount, $product->discount_type) !!}</p>
                        </div>
                        <div class="p-wishlist-share"><a href="#"
                                                         onclick="event.preventDefault();addToWishlist({{$product->id}})"><i
                                    class="lni lni-heart"></i></a>
                        </div>

                    </div>
                    <!-- Ratings-->
                    <div class="product-ratings">
                        <div class="container d-flex align-items-center justify-content-between">
                            <div class="ratings">
                                {!! \App\Helper::ratingHtml(round($product->rating, 0, PHP_ROUND_HALF_UP)) !!}
                                <span class="ps-1"> {{ round($product->rating, 0, PHP_ROUND_HALF_UP) }}
                                    {{ \Illuminate\Support\Str::plural('rating', $product->rating) }}</span>
                            </div>

                            <div class="badge badge-success">
                                <span>{{ \App\Helper::getPointHtml($product->point) }}
                            </div>
                        </div>
                    </div>
                </div>
            @if($show_flash ?? '')
                <!-- Flash Sale Panel-->
                    <div class="flash-sale-panel bg-white mb-3 py-3">
                        <div class="container d-flex align-items-center justify-content-between">
                            <!-- Sales Offer Content-->
                            <!-- Sales End-->
                            <div class="sales-end">
                                <p class="mb-1 font-weight-bold"><i class="lni lni-bolt"></i> Flash sale end in</p>
                            </div>
                            <!-- Sales Volume-->
                            <div>
                                <x-frontend.countdown :time="$flash_end"/>
                            </div>
                        </div>
                    </div>
            @endif

            @if($product->is_variant)
                <!-- Selection Panel-->
                    <div class="selection-panel bg-white mb-3 py-3">
                        <form id="variation-form">
                            <div class="container d-flex align-items-center justify-content-between">
                            @if(isset($product->colors))
                                <!-- Choose Color-->
                                    <div class="choose-color-wrapper">
                                        <p class="mb-1 font-weight-bold">Colors</p>
                                        <div class="choose-color-radio d-flex align-items-center w-50">
                                        @foreach(json_decode ($product->colors) as $key=>$color)
                                            <!-- Single Radio Input-->
                                                <div class="form-check mb-0 ">
                                                    <input class="form-check-input {{ $color }} color-radio"
                                                           id="colorRadio{{$key}}"
                                                           type="radio"
                                                           name="color"
                                                           value="{{ $color }}"
                                                           checked>
                                                    <label class="form-check-label" for="colorRadio{{$key}}"></label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                            @endif
                            @if(isset($product->sizes))
                                <!-- Choose Size-->
                                    <div class="choose-size-wrapper text-end">
                                        <p class="mb-1 font-weight-bold">Sizes</p>
                                        <div class="choose-size-radio d-flex align-items-center">
                                        @foreach(explode (',', $product->sizes) as $key=>$size)
                                            <!-- Single Radio Input-->
                                                <div class="form-check mb-0 me-2 ">
                                                    <input class="form-check-input size-radio" id="sizeRadio{{$key}}"
                                                           type="radio"
                                                           name="size" value="{{ $size }}">
                                                    <label class="form-check-label"
                                                           for="sizeRadio{{$key}}">{{ ucfirst ($size) }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
            @endif
            <!-- Add To Cart-->
                <div class="cart-form-wrapper bg-white mb-3 py-3">
                    <div class="container d-flex align-items-center justify-content-between">
                        <form class="cart-form"
                              onsubmit="event.preventDefault(); send_to_cart()">
                            <div class="order-plus-minus d-flex align-items-center">
                                <div class="quantity-button-handler">-</div>
                                <input class="form-control cart-quantity-input" type="text" step="1" name="quantity"
                                       value="1" id="cart-quantity-input">
                                <div class="quantity-button-handler">+</div>
                            </div>
                            <button class="btn btn-danger ms-3 " id="send-to-cart" type="submit">Add To Cart</button>
                        </form>
                        <div class="badge badge-success">
                            {{ \App\Helper::getProductStock ($product) > 0 ? 'In stock' : 'Out of stock' }}
                        </div>
                    </div>
                </div>
                <!-- Product Specification-->
                <div class="p-specification bg-white mb-3 py-3">
                    <div class="container">
                        <h6>Delivery Details</h6>
                        <p>Product will be delivered within 4 days in Dhaka. For outside Dhaka, Delivery time will be 7
                            to 10 days. Delivery charge for inside Dhaka @taka(60) and outside Dhaka @taka(100)</p>
                    </div>
                </div>
                <div class="p-specification bg-white mb-3 py-3">
                    <div class="container">
                        <h6>Specifications</h6>

                        {!! $product->description !!}

                    </div>
                </div>

            @if(count($product->allReviews))
                <!-- Rating & Review Wrapper-->
                    <div class="rating-and-review-wrapper bg-white py-3 mb-3">
                        <div class="container">
                            <h6>Ratings &amp; Reviews</h6>
                            <div class="rating-review-content">
                                <ul class="ps-0">
                                    @each('components.frontend.rating', $product->allReviews, 'item')
                                </ul>
                            </div>
                        </div>
                    </div>
            @endif
            @auth
                <!-- Ratings Submit Form-->
                    <div class="ratings-submit-form bg-white py-3">
                        <div class="container">
                            <h6>Submit A Review</h6>

                            <form action="{{ route('submit.review') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ encrypt($product->id) }}">
                                <div class="stars mb-3">
                                    <input class="star-1" type="radio" name="rating" value="1" id="star1">
                                    <label class="star-1" for="star1"></label>
                                    <input class="star-2" type="radio" name="rating" value="2" id="star2">
                                    <label class="star-2" for="star2"></label>
                                    <input class="star-3" type="radio" name="rating" value="3" id="star3">
                                    <label class="star-3" for="star3"></label>
                                    <input class="star-4" type="radio" name="rating" value="4" id="star4">
                                    <label class="star-4" for="star4"></label>
                                    <input class="star-5" type="radio" name="rating" value="5" id="star5">
                                    <label class="star-5" for="star5"></label><span></span>
                                </div>
                                <textarea class="form-control mb-3" id="comments" name="comment" cols="30" rows="10"
                                          data-max-length="200" placeholder="Write your review..."></textarea>
                                <button class="btn btn-sm btn-primary" type="submit">Save Review</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>

    </div>
@endsection
@push('front-script')
    <script>
        let variant = null;
        function send_to_cart() {
            addToCart('{{ $product->id }}', document.querySelector('#cart-quantity-input').value, variant)
        }
        $(document).ready(function () {

            $(".color-radio").click(() => {
                let variation = $("#variation-form").serializeArray().map(x => x.value);
                variant = sku($("div.p-title-price > h6").text(), variation[0], variation[1]);
            });
            $(".size-radio").click(() => {
                let variation = $("#variation-form").serializeArray().map(x => x.value);
                variant = sku($("div.p-title-price > h6").text(), variation[0], variation[1]);
            });
        });
    </script>
    @if($product->is_variant)
        <script>
            let cartButton = $("#send-to-cart");
            $("#variation-form").serializeArray().map(x => x.value).length === 0 ? cartButton.attr('disabled', true) : cartButton.removeAttr('disabled');
        </script>
    @endif

@endpush
