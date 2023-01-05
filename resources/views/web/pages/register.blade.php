@extends('web.layouts.auth')
@section('auth-content')
<div class="login-wrapper d-flex align-items-center justify-content-center text-center">
    <!-- Background Shape-->
    <div class="background-shape"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-9">
                <img class="big-logo w-25" src="{{asset('frontend/img/icons/logo-bg-remove.png')}}" alt="">
                <!-- Register Form-->
                <div class="register-form mt-5 px-4">
                    <form action="{{ route('b2e.save.user') }}" method="POST" class="row">
                        @csrf
                        <div class="form-group text-start mb-4 col-12  col-xl-6">
                            <span>Name</span>
                            <label for="name">
                                <i class="lni lni-user"></i>
                            </label>
                            <input class="form-control @error('name') is-invalid @enderror" required name="name"
                                type="text" placeholder="Enter your name" value="{{ old('name') }}">
                            @error('name')
                            <span class="invalid-feedback text-capitalize text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group text-start mb-4 col-12  col-xl-6">
                            <span>Username</span>
                            <label for="username">
                                <i class="lni lni-user"></i>
                            </label>
                            <input class="form-control @error('username') is-invalid @enderror" id="username" required
                                name="username" type="text" placeholder="Enter your name" value="{{ old('username') }}">
                            @error('username')
                            <span class="invalid-feedback text-capitalize text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group text-start mb-4 col-12  col-xl-6">
                            <span>Email</span>
                            <label for="email">
                                <i class="lni lni-envelope"></i>
                            </label>
                            <input class="form-control @error('email') is-invalid @enderror" required name="email"
                                id="email-username" type="email" placeholder="Enter your email address"
                                value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback text-capitalize text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group text-start mb-4 col-12  col-xl-6">
                            <span>Password</span>
                            <label for="password">
                                <i class="lni lni-lock"></i>
                            </label>
                            <input class="input-psswd form-control @error('password') is-invalid @enderror" required
                                name="password" id="registerPassword" type="password" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback text-capitalize text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group text-start mb-4 col-12  col-xl-6">
                            <span>Confirm Password</span>
                            <label for="password">
                                <i class="lni lni-lock"></i>
                            </label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Confirm your password">

                        </div>
                        <button class="btn btn-success btn-lg w-100" type="submit">Sign Up</button>
                    </form>
                </div>
                <!-- Login Meta-->
                <div class="login-meta-data">
                    <p class="mt-3 mb-0">Already have an account?<a class="ms-1" href="{{route('b2e.login')}}">Sign
                            In</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('auth-script')
<script src="{{ asset('frontend/js/default/jquery.passwordstrength.js') }}"></script>
<script>
    let username = $('#email-username').val().split('@')[0];
        if(username) $('#username-holder').empty().append(`<label class="text-light">Your username will be <strong class="text-warning">${username}</strong></label><input type="hidden"  name="username" value="${username}">`);
        $('#registerPassword').passwordStrength({
            minimum: 4,
            tooltip: true
        });
        // $('#email-username').on('change', function () {
        //     username = $(this).val().split('@')[0];
        //     $('#username-holder').empty().append(`<label class="text-light">Your username will be <strong class="text-warning">${username}</strong></label><input type="hidden"  name="username" value="${username}">`);
        // });
</script>
@endpush