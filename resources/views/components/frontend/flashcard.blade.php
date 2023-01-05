<div class="card flash-sale-card">
    <div class="card-body">
        <a href="{{route('shop.product', ['product'=>$item->slug])}}">
            <div class="total-result-of-ratings">
                <span class="badge badge-success p-1">{{ \App\Helper::getPointHtml($item->point) }}</span>
            </div>
            <img src="{{ \App\Helper::getProductImage($item->thumbnail_img) }}" alt="">
            <span class="product-title text-truncate">{{$item->name}}</span>
            <p class="sale-price">{!! \App\Helper::formatSinglePrice($item->sale_price, $item->discount, $item->discount_type) !!}</p>
        </a>
    </div>
</div>
