@extends('web.layouts.layout')
@section('content')
<div class="page-content-wrapper">
    <!-- Top Products-->
    <div class="top-products-area py-3">
        <div class="container">
            <div class="section-heading d-flex align-items-center justify-content-between">
                <h6>{{ request('search') ? "Search result for - ".request('search') : "All Products" }}</h6>
                <!-- Select Product Catagory-->
                {{--          <div class="select-product-catagory">--}}
                {{--            <select class="form-select" id="selectProductCatagory" name="selectProductCatagory" aria-label="Default select example">--}}
                {{--              <option selected>Short by</option>--}}
                {{--              <option value="1">Newest</option>--}}
                {{--              <option value="2">Popular</option>--}}
                {{--              <option value="3">Ratings</option>--}}
                {{--            </select>--}}
                {{--          </div>--}}
            </div>
            @if(count($categories))
            <div class="product-catagories">
                <div class="row g-3">
                    @foreach ($categories as $category)
                    <!-- Single Catagory-->
                    <div class="col-4"><a class="shadow-sm"
                            href="{{route('shop.category', ['category'=>$category->slug])}}"><img class="img-fluid"
                                src="{{ $category->image ? asset($category->image) : asset('frontend/img/category/woman.svg') }}"
                                alt="">{{$category->name}}</a></div>
                    @endforeach
                </div>
            </div>
            @endif
            <div class="row g-3">
                @each('components.frontend.product.top_product', $products, 'item')
            </div>
            <div class="mt-3">
                {{ $products->render() }}
            </div>
        </div>
    </div>
</div>
@endsection