@extends('web.layouts.layout')
@php
$feature_products = \App\Models\Products::query()->latest()->where('status', 1)->limit(8)->get();
@endphp

@section('content')
<div class="page-content-wrapper">
  <div class="container">
    <!-- Checkout Wrapper-->
    <div class="checkout-wrapper-area py-3">
      <div class="credit-card-info-wrapper"><img class="d-block mb-4" src="img/bg-img/credit-card.png" alt="">
        <div class="pay-credit-card-form">
          <form action="payment-success.html" method="">
            <div class="mb-3">
              <label for="paypalEmail">Email Address</label>
              <input class="form-control" type="email" id="paypalEmail" placeholder="paypal@example.com" value=""><small
                class="ms-1"><i class="fa fa-lock me-1"></i>Secure online payments at the speed of want.<a class="ms-1"
                  href="#">Learn More</a></small>
            </div>
            <div class="mb-3">
              <label for="paypalPassword">Password</label>
              <input class="form-control" type="password" id="paypalPassword" value="">
            </div>
            <button class="btn btn-warning btn-lg w-100" type="submit">Pay Now</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection