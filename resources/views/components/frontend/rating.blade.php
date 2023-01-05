<li class="single-user-review d-flex">
    <div class="user-thumbnail">
        <img src="" alt="">
    </div>
    <div class="rating-comment">
        <div class="rating">
            {!! \App\Helper::ratingHtml(round($item->rating, 0, PHP_ROUND_HALF_UP))  !!}
        </div>
        <p class="comment mb-0">{{$item->comment}}</p>
        <span class="name-date">{{$item->created_at->format('d-m-Y h:i A')}}</span>
    </div>
</li>