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
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ request()->route()->parameter('token')  }}">

                        <div class="form-group text-start mb-4"><span>{{ __('E-Mail Address') }}</span>
                            <label for="username"><i class="lni lni-user"></i></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ request('email') ?? old('email') }}" required
                                autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback text-capitalize text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group text-start mb-4"><span>{{ __('Password') }}</span>
                            <label for="username"><i class="lni lni-user"></i></label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                            <span class="invalid-feedback text-capitalize text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group text-start mb-4"><span>{{ __('Confirm Password') }}</span>
                            <label for="username"><i class="lni lni-user"></i></label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>


                        <button type="submit" class="btn btn-success btn-lg w-100">
                            {{ __('Reset Password') }}
                        </button>


                    </form>

                </div>
                <!-- View As Guest-->
                <div class="view-as-guest mt-3"><a class="btn" href="{{route('shop')}}">View as Guest</a></div>
            </div>
        </div>
    </div>
</div>
@endsection