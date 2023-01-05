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
                    @if (session('error'))
                    <div class="mb-5 text-warning" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form action="{{ route('shop.login') }}" method="post">
                        @csrf
                        <div class="form-group text-start mb-4"><span>Username</span>
                            <label for="username"><i class="lni lni-user"></i></label>
                            <input class="form-control @error('username') is-invalid @enderror" name="username"
                                id="username" type="text" placeholder="Enter your username">
                            @error('username')
                            <span class="invalid-feedback text-capitalize text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group text-start mb-4"><span>Password</span>
                            <label for="password"><i class="lni lni-lock"></i></label>
                            <input class="form-control @error('password') is-invalid @enderror" id="password"
                                name="password" type="password" placeholder="Enter your password">
                            @error('password')
                            <span class="invalid-feedback text-capitalize text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button class="btn btn-success btn-lg w-100" type="submit">Log In</button>
                    </form>
                </div>
                <!-- Login Meta-->
                <div class="login-meta-data">
                    <a class="forgot-password d-block mt-3 mb-1" href="{{ route('shop.forget-password') }}">Forgot
                        Password?</a>
                    <p class="m-3">Didn't have an account?<a class="ms-1" href="{{route('b2e.signup')}}">Register
                            Now</a></p>
                </div>
                <!-- View As Guest-->
                <div class="view-as-guest mt-3"><a class="btn" href="{{route('shop')}}">View as Guest</a></div>
            </div>
        </div>
    </div>
</div>
@endsection