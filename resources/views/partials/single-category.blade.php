<!-- Single Catagory Card-->
<div class="col-4">
    <div class="card catagory-card">
        <div class="card-body"><a href="{{route('shop.category', ['category'=>$item->slug])}}">
                <img style="height: 28px; width: 28px; object-fit:cover" class="mb-2" src="{{asset($item->image)}}"
                    alt="{{$item->name}}"><span>{{$item->name}}</span></a></div>
    </div>
</div>