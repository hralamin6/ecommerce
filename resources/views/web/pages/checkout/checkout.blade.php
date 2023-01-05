@extends('web.layouts.layout')
@push('front-style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container {
        font-size: 14px;
        text-align: end;
    }
    span.select2-selection__arrow {
        left: 0;
    }
</style>
@endpush
@section('content')
<div class="page-content-wrapper">
    <div class="container">
        <!-- Checkout Wrapper-->
        <div class="checkout-wrapper-area py-3">
            @if ($errors->any())
            <div class="billing-information-card mb-3">
                <div class="card billing-information-title-card bg-danger">
                    <div class="card-body">
                        <h6 class="text-center mb-0 text-white">We have found some error</h6>
                    </div>
                </div>
                <div class="card user-data-card">
                    <div class="card-body text-danger">
                        @foreach ($errors->all() as $error)
                        <li class="text-capitalize">{{ $error }}</li>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            <form action="{{ route('checkout.confirm') }}" method="post">
                @csrf
                <!-- Billing Address-->
                <div class="billing-information-card mb-3">
                    <div class="card billing-information-title-card bg-success">
                        <div class="card-body">
                            <h6 class="text-center mb-0 text-white">Delivery Address</h6>
                        </div>
                    </div>
                    <div class="card user-data-card">
                        <div class="card-body">
                            <div class="single-profile-data d-flex align-items-center justify-content-between">
                                <div class="title d-flex align-items-center"><i class="lni lni-user"></i><span>Full
                                        Name</span>
                                </div>
                                <input type="text" class="data-content form-control" name="name"
                                    value="{{ old('name', auth()->user()->name ?? '') }}">
                            </div>
                            <div class="single-profile-data d-flex align-items-center justify-content-between">
                                <div class="title d-flex align-items-center"><i
                                        class="lni lni-phone"></i><span>Phone</span>
                                </div>
                                <input type="text" class="data-content form-control" name="phone"
                                    value="{{ old('phone',auth()->user()->phone ?? '') }}">
                            </div>
                            <div class="single-profile-data d-flex align-items-center justify-content-between">
                                <div class="title d-flex align-items-center"><i
                                        class="lni lni-map-marker"></i><span>Road/House</span>
                                </div>
                                <input name="delivery_address" class="form-control data-content" id="delivery"
                                    value="{{ old('delivery_address', auth()->user()->shipping ?? '') }}"  />
                            </div>
                            <div class="single-profile-data d-flex align-items-center justify-content-between">
                                <div class="title d-flex align-items-center"><i
                                        class="lni lni-postcard"></i><span>Postal Code</span>
                                </div>
                                <input type="number" class="data-content form-control" name="postal_code"
                                    value="{{ old('postal_code') }}">
                            </div>
                            <div class="single-profile-data d-flex align-items-center justify-content-between">
                                <div class="title d-flex align-items-center"><i
                                        class="lni lni-map"></i><span>District</span>
                                </div>
                                <select class="form-control data-content select2" name="district" id="get-sub-district"
                                    >
                                    <option value="">Select One</option>
                                    @foreach(\App\Models\Districts::whereStatus(1)->orderBy('name','asc')->pluck('name','id')
                                    as
                                    $key => $district)
                                    <option value="{{ $district }}" data-id="{{ $key }}" @if(old('district')==$district)
                                        selected @endif>{{ $district }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="single-profile-data d-flex align-items-center justify-content-between">
                                <div class="title d-flex align-items-center"><i class="lni lni-map"></i><span>Sub
                                        District</span>
                                </div>
                                <select  class="form-control data-content" name="sub_district"
                                    id="set-sub-district">


                                </select>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- Delivery Charge-->
                <div class="shipping-method-choose mb-3">
                    <div class="card shipping-method-choose-title-card bg-success">
                        <div class="card-body">
                            <h6 class="text-center mb-0 text-white">Delivery Charge</h6>
                        </div>
                    </div>
                    <div class="card shipping-method-choose-card">
                        <div class="card-body">
                            <div class="shipping-method-choose">
                                <div class="ps-0 row">
                                    <div class="col-md-6">
                                        <label>Inside Dhaka <span class="badge badge-primary">{{$data['delivery_inside_dhaka']}}</span> BDT</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Outside Dhaka <span class="badge badge-primary">{{$data['delivery_outside_dhaka']}}</span> BDT</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Delivery Time-->
                <div class="shipping-method-choose mb-3">
                    <div class="card shipping-method-choose-title-card bg-success">
                        <div class="card-body">
                            <h6 class="text-center mb-0 text-white">Delivery Time</h6>
                        </div>
                    </div>
                    <div class="card shipping-method-choose-card">
                        <div class="card-body">
                            <div class="shipping-method-choose">
                                <div class="ps-0 row">
                                    <div class="col-md-6">
                                        <label>Inside Dhaka <span class="badge badge-primary">{{$data['delivery_time_inside_dhaka']}}</span> Days</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Outside Dhaka <span class="badge badge-primary">{{$data['delivery_time_outside_dhaka']}}</span> Days</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Shipping Method Choose-->
                <div class="shipping-method-choose mb-3">
                    <div class="card shipping-method-choose-title-card bg-success">
                        <div class="card-body">
                            <h6 class="text-center mb-0 text-white">Payment Method </h6>
                        </div>
                    </div>
                    <div class="card shipping-method-choose-card">
                        <div class="card-body">
                            <div class="shipping-method-choose">
                                <ul class="ps-0">
                                    <li>
                                        <input id="fastShipping" type="radio" name="payment_type"
                                            class="payment_type_checkbox" value="0" checked>
                                        <label for="fastShipping">Cash on delivery</label>
                                        <div class="check"></div>
                                    </li>
                                    <li>
                                        <input id="mobileShipping" type="radio" name="payment_type"
                                            class="payment_type_checkbox" value="3">
                                        <label for="mobileShipping">Mobile Banking </label>
                                        <div class="check"></div>
                                    </li>
                                    <li>
                                        <input id="sslcommerz" type="radio" name="payment_type"
                                            class="payment_type_checkbox" value="4">
                                        <label for="sslcommerz">Pay By SslCommerz </label>
                                        <div class="check"></div>
                                    </li>
                                    <li id="mobile-payment-holder" class="card user-data-card shadow-none py-2"
                                        style="display: none">
                                        <p class="text-center">Please send full amount To
                                           <strong>{{$payment_number?? "Not set yet"}}</strong>
                                        </p>
                                        <div
                                            class="single-profile-data d-flex align-items-center justify-content-between">
                                            <div class="title d-flex align-items-center"><i
                                                    class="lni lni-user"></i><span>Payment from</span>
                                            </div>
                                            <input type="text" class="data-content form-control" name="payment_from"
                                                value="{{ old('payment_from', '') }}">
                                        </div>
                                        <div
                                            class="single-profile-data d-flex align-items-center justify-content-between">
                                            <div class="title d-flex align-items-center"><i
                                                    class="lni lni-user"></i><span>TRX ID</span>
                                            </div>
                                            <input type="text" class="data-content form-control" name="trx"
                                                value="{{ old('trx', '') }}">
                                        </div>
                                    </li>
                                    @premium
                                    <li>
                                        <input id="normalShipping" type="radio" name="payment_type"
                                            class="payment_type_checkbox" value="1">
                                        <label for="normalShipping">E-Balance (@taka(auth()->user()->point))</label>
                                        <div class="check"></div>
                                    </li>
                                    <li>
                                         <input id="balanceShipping" type="radio" name="payment_type"
                                            class=payment_type_checkbox value="2">
                                         <label for="balanceShipping">I-Balance
                                            (@taka(auth()->user()->balance))</label>
                                         <div class="check"></div>
                                         </li>
                                    @endpremium

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="shipping-method-choose mb-3">
                        <div class="card shipping-method-choose-card">
                            <div class="card-body">
                                <div class="shipping-method-choose">
                                    <input id="agreement" type="checkbox" name="agreement" class="lni-checkbox" value="0">
                                    <label for="agreement">By clicking you're agree to our
                                        <a href="{{route('terms-conditions')}}">Terms & Conditions</a>,
                                        <a href="{{route('privacy-policy')}}">Privacy Policy</a>,
                                        <a href="{{route('refund-policy')}}">Refund Policy</a> and
                                        <a href="{{route('terms-service')}}">Terms of Service</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Cart Amount Area-->
                <div class="card cart-amount-area">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <h5 class="total-price mb-0">{{ \App\Helper::counter_price($total)}}</h5>
                        <button id="pay-with-others" type="submit" class="btn btn-warning">Confirm</button>
                        <button id="pay-with-sslcommerz" style="display: none; width: 80%" type="submit"><img src="https://securepay.sslcommerz.com/public/image/SSLCommerz-Pay-With-logo-All-Size-01.png" alt=""></button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
@push('front-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

    $(document).on('click', '.payment_type_checkbox', () => {
        if ($("#mobileShipping").prop("checked")) $("#mobile-payment-holder").show(); else {
            $("#mobile-payment-holder").hide();
            $("#mobile-payment-holder > div:nth-child(1) > input").val('');
            $("#mobile-payment-holder > div:nth-child(2) > input").val('');
        }
    });
    $(document).on('click', '.payment_type_checkbox', () => {
        if ($("#sslcommerz").prop("checked")){
            $("#pay-with-sslcommerz").show();
            $("#pay-with-others").hide();
        }
        else {
            $("#pay-with-sslcommerz").hide();
            $("#pay-with-others").show();
        }
    });
    $("#get-sub-district").select2();
    $("#get-sub-district").change(function () {
        let selectedDistrict = $(this).children("option:selected");
        if (selectedDistrict.val() === 'Dhaka') $('.total-price').text('৳ ' + (parseInt("{{ $total }}") + parseInt("{{ $inside_dhaka }}")));
        else $('.total-price').text('৳ ' + (parseInt("{{ $total }}") + parseInt("{{ $outside_dhaka }}")));
        $.get("{{ route('get.subDistrict') }}", { district: selectedDistrict.data('id'), })
            .success(response => {
                let html = '';
                $.each(response, function (indexInArray, valueOfElement) {
                    html += `<option class="text-end" value="${valueOfElement}">${valueOfElement}</option>`;
                });

                $("#set-sub-district").html(html);
            }).error(error => {
                notyf.error(JSON.parse(error.responseText).message);
            });
    })
    $("form").submit(function(){
        if ( $('input[type="checkbox"]:checked').length == 0  ) {
            alert("You must be agree to our conditions");
            return false;
        }
    });
</script>
@endpush
