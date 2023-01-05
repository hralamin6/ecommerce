@extends('web.layouts.layout')
@section('content')
<div class="container pt-3">
    <div class="section-heading mt-3">
        <h5 class="mb-1">Create new child account</h5>
        <p class="mb-4">Send 1100/- taka to 01234100100 before create account</p>
    </div>
    <!-- Contact Form-->
    <div class="contact-form mt-3 pb-3">
        <form action="{{ route('b2e.child.save') }}" method="post" class="needs-validation">
            @csrf
            <input required class="form-control mb-1" id="username" name="username" type="text"
                placeholder="Username for new account" value="{{ old('username') }}">
            @error('username')
            <div class="invalid-feedback d-block mb-1 text-capitalize">
                {{ $message }}
            </div>
            @enderror
            <input class="form-control mb-1" id="referral" name="referral_user" type="text"
                placeholder="Referral user for new account" value="{{ old('referral_user') }}">
            @error('referral_user')
            <div class="invalid-feedback d-block mb-1 text-capitalize">
                {{ $message }}
            </div>
            @enderror
            <input required class="form-control mb-1" id="trx" name="trx" type="text"
                placeholder="Trx number of payment" value="{{ old('trx') }}">
            @error('trx')
            <div class="invalid-feedback d-block mb-1 text-capitalize">
                {{ $message }}
            </div>
            @enderror
            <input required class="form-control mb-1" id="sender_number" name="sender_number" type="text"
                placeholder="Payment sender number" value="{{ old('sender_number') }}">
            @error('sender_number')
            <div class="invalid-feedback d-block mb-1 text-capitalize">
                {{ $message }}
            </div>
            @enderror
            <button type="submit" class="btn btn-success btn-lg w-100">Send request</button>
        </form>
    </div>
</div>
@endsection