@extends('web.layouts.layout')
@section('content')
{{--        @dd($order)--}}
<div class="page-content-wrapper">
    <div class="container">
        <!-- Cart Wrapper-->
        <div class="cart-wrapper-area py-3">
            <!-- Coupon Area-->
            <div class="card coupon-card mb-3">
                <div class="card-body">
                    <div class="apply-coupon">
                        {!! $order->shipping_address !!}
                        <p class="mb-2"><strong>Delivery Status</strong> {{ $order->delivery_status }}</p>
                        <p class="mb-2"><strong>Payment Status</strong> {{ $order->payment_status }}</p>

                    </div>
                </div>
            </div>
            <div id="cart-view">
                <!-- Cart Area-->
                <div class="cart-table card mb-3">
                    <div class="table-responsive card-body">
                        <table class="table mb-0">
                            <tbody>
                                @foreach($order->allOrderDetails as $item)
                                <tr>
                                    <th scope="row">
                                        #{{ $loop->iteration }}
                                    </th>
                                    <td><img src="{{\App\Helper::getProductImage($item->products->thumbnail_img)}}"
                                            alt=""></td>
                                    <td>
                                        <a href="{{ route('shop.product', ['product'=>$item->products->slug]) }}">{{$item->products->name}}
                                            <span>{{ \App\Helper::counter_price( $item->price ) }} ×
                                                {{$item->quantity}}</span></a>
                                    </td>
                                    <td class="float-end">
                                        <strong>@taka($item->quantity * $item->price)</strong>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3">Shipping Cost</td>
                                    <td class="float-end">
                                        <strong>@taka($order->shipping_cost)</strong>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Cart Amount Area-->

            <div class="card cart-amount-area">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <a class="btn btn-warning" href="{{ route('b2e.my-orders') }}">Back</a>
                    <h5 class="total-price mb-0">{!! \App\Helper::counter_price($order->grand_total, true) !!}</h5>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection