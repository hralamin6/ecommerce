<!-- Single Top Product Card-->
<div class="col-6 col-md-4 col-lg-3">
    <div class="card top-product-card">
        <div class="card-body">
            <a class="wishlist-btn" href="#" onclick="event.preventDefault();removeFromWishlist({{$item->products->id}})">
                <i class="lni lni-cross-circle"></i>
            </a>
            <div class="total-result-of-ratings">
                <span class="badge badge-success p-1">{{ \App\Helper::getPointHtml($item->products->point) }}</span>
            </div>
            <a class="product-thumbnail d-block" href="{{ route('shop.product',['product'=>$item->products->slug]) }}">
                <img class="mb-2" src="{{ \App\Helper::getProductImage($item->products->thumbnail_img) }}"
                    alt="{{ $item->products->name }}"></a>
            <a class="product-title d-block"
                href="{{ route('shop.product',['product'=>$item->products->slug]) }}">{{ $item->products->name }}</a>
            <p class="sale-price">$38<span>$41</span>
            </p>
            <div class="product-rating">
                {!! \App\Helper::ratingHtml($item->products->rating) !!}
            </div>
            <a class="btn btn-success btn-sm" href="#"
                onclick="event.preventDefault();addToCart({{$item->products_id}})">
                <i class="lni lni-plus"></i>
            </a>
        </div>
    </div>
</div>
