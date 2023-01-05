<div class="col-6 col-md-4 col-lg-3">
  <div class="card top-product-card">
    <div class="card-body">
      <a class="wishlist-btn" href="#" onclick="addToWishlist({{$item->id}})">
        <i class="lni lni-heart"></i>
      </a>
      <div class="total-result-of-ratings">
        <span class="badge badge-success p-1">{{ \App\Helper::getPointHtml($item->point) }}</span>
      </div>
      <a class="product-thumbnail d-block" href="{{route('shop.product', ['product'=>$item->slug])}}">
        <img style="height: 185px; object-fit:contain" src="{{ (new \App\Helper())->getProductImage($item->thumbnail_img) }}" alt="{{$item->slug}}" class="mb-2">
      </a>
      <a class="product-title d-block text-truncate" href="{{route('shop.product', ['product'=>$item->slug])}}">{{$item->name}}</a>
      <p class="sale-price">{!! \App\Helper::formatSinglePrice($item->sale_price, $item->discount, $item->discount_type) !!}</p>
      <div class="product-rating">
        @for ($i = 0; $i < $item->rating; $i++)
          <i class="lni lni-star-filled"></i>
        @endfor
        @if ( $item->rating == null)
          <i class="lni lni-star-unfilled"></i>
        @endif
      </div>
      <a class="btn btn-success btn-sm" @if($item->is_variant) href="{{route('shop.product', ['product'=>$item->slug])}}" @else href="#" onclick="addToCart({{ $item->id  }})" @endif> <i class="lni lni-plus"></i></a>
    </div>
  </div>
</div>
