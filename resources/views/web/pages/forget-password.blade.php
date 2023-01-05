@extends('web.layouts.auth')
@section('auth-content')
<!-- Login Wrapper Area-->
<div class="login-wrapper d-flex align-items-center justify-content-center text-center">
    <!-- Background Shape-->
    <div class="background-shape"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5">
                <img class="big-logo w-25" src="{{ asset('frontend/img/icons/logo-bg-remove.png') }}" alt="">

                <!-- Register Form-->
                <div class="register-form mt-5 px-4">
                    @if (session('status'))
                    <div class="mb-5 text-warning" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{ route('shop.password.email') }}" method="post">
                        @csrf
                        <div class="form-group text-start mb-4"><span>Email</span>
                            <label for="email"><i class="lni lni-user"></i></label>
                            <input class="form-control" id="email" type="text" name="email"
                                placeholder="Enter you email">
                            @error('email')
                            <span class="invalid-feedback text-capitalize text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button class="btn btn-warning btn-lg w-100" type="submit">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection