@extends('web.layouts.layout')

@section('content')
<div class="page-content-wrapper">
    <div class="container">
        <!-- Cart Wrapper-->
            <h5>tran_id = {{@$datas['tran_id']}}</h5>
            <h5>val_id = {{@$datas['val_id']}}</h5>
            <h5>amount = {{@$datas['amount']}}</h5>
            <h5>card_type = {{@$datas['card_type']}}</h5>
            <h5>store_amount = {{@$datas['store_amount']}}</h5>
            <h5>card_no = {{@$datas['card_no']}}</h5>
            <h5>bank_tran_id = {{@$datas['bank_tran_id']}}</h5>
            <h5>status = {{@$datas['status']}}</h5>
            <h5>tran_date = {{@$datas['tran_date']}}</h5>
            <h5>error = {{@$datas['error']}}</h5>
            <h5>currency = {{@$datas['currency']}}</h5>
            <h5>card_issuer = {{@$datas['card_issuer']}}</h5>
            <h5>card_brand = {{@$datas['card_brand']}}</h5>
            <h5>card_sub_brand = {{@$datas['card_sub_brand']}}</h5>
            <h5>card_issuer_country = {{@$datas['card_issuer_country']}}</h5>
            <h5>card_issuer_country_code = {{@$datas['card_issuer_country_code']}}</h5>
            <h5>store_id = {{@$datas['store_id']}}</h5>
            <h5>verify_sign = {{@$datas['verify_sign']}}</h5>
            <h5>verify_key = {{@$datas['verify_key']}}</h5>
            <h5>verify_sign_sha2 = {{@$datas['verify_sign_sha2']}}</h5>
            <h5>currency_type = {{@$datas['currency_type']}}</h5>
            <h5>currency_amount = {{@$datas['currency_amount']}}</h5>
            <h5>currency_rate = {{@$datas['currency_rate']}}</h5>
            <h5>base_fair = {{@$datas['base_fair']}}</h5>
            <h5>value_a = {{@$datas['value_a']}}</h5>
            <h5>value_b = {{@$datas['value_b']}}</h5>
            <h5>value_c = {{@$datas['value_c']}}</h5>
            <h5>value_d = {{@$datas['value_d']}}</h5>
            <h5>subscription_id = {{@$datas['subscription_id']}}</h5>
            <h5>risk_level = {{@$datas['risk_level']}}</h5>
            <h5>risk_title = {{@$datas['risk_title']}}</h5>
        <div class="cart-wrapper-area py-3">
            <!-- Coupon Area-->
                            <div class="card coupon-card mb-3">
                                <div class="card-body">
                                    <div class="apply-coupon">
                                        <h6 class="mb-0">Have a coupon?</h6>
                                        <p class="mb-2">Enter your coupon code here &amp; get awesome discounts!</p>
                                        <div class="coupon-form">
                                            <form id="apply-coupon">
                                                <input class="form-control" type="text" placeholder="Enter Your Coupon" id="code">
                                                <button class="btn btn-primary">Apply</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
            <div id="cart-view">
                @include('web.partials.cartlist')
            </div>
            <!-- Cart Amount Area-->
            @if($carts['count']!=0)
            <div class="card cart-amount-area">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <h5 class="total-price mb-0">{!! \App\Helper::counter_price($carts['total'], true) !!}</h5>
                    <a class="btn btn-warning" href="{{ route('checkout') }}">Checkout Now</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
@push('front-script')
<script>
    $("#apply-coupon").submit(function (event) {
            event.preventDefault();
            $.post("{{ route('cart.applyCoupon') }}", {code: $("#code").val()}).success(function (response, xhr) {
                $("#apply-coupon").trigger('reset');
                $(".total-price").empty().html(`৳ <span class="counter">${response.discount}</span> ৳ <span class="d-inline-block text-decoration-line-through">${response.total}</span> `);
            }).error(function (error) {
                notyf.error((JSON.parse(error.responseText).errors.code[0]));
            })
        })
</script>
@endpush
