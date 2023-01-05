<div class="col-12 col-md-6">
    <div class="card weekly-product-card">
        <div class="card-body d-flex align-items-center">
            <div class="product-thumbnail-side">
                <div class="total-result-of-ratings">
                    <span class="badge badge-success p-1">{{ \App\Helper::getPointHtml($item->point) }}</span>
                </div>
                <a class="wishlist-btn" href="#" onclick="addToWishlist({{$item->id}})">
                    <i class="lni lni-heart"></i>
                </a>
                <a class="product-thumbnail d-block" href="{{ route('shop.product', ['product'=>$item->slug]) }}">
                    <img src="{{ (new \App\Helper())->getProductImage($item->thumbnail_img) }}" alt="{{$item->name}}">
                </a>
            </div>
            <div class="product-description">
                <a class="product-title d-block text-truncate"
                   href="{{ route('shop.product', ['product'=>$item->slug]) }}">{{$item->name}}</a>
                <p class="sale-price">{!! \App\Helper::formatSinglePrice($item->sale_price, $item->discount, $item->discount_type) !!}</p>
                <div class="product-rating"><i class="lni lni-star-filled"></i>{{ $item->rating}}
                    ({{$item->allReviews->count('id')}})
                </div>
                <a class="btn btn-danger btn-sm" @if($item->is_variant) href="{{route('shop.product', ['product'=>$item->slug])}}" @else href="#" onclick="addToCart({{ $item->id  }})" @endif><i
                            class="me-1 lni lni-cart"></i>Buy Now</a>
            </div>
        </div>
    </div>
</div>
