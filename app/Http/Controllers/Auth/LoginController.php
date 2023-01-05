<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;
    use App\Providers\RouteServiceProvider;
    use Illuminate\Foundation\Auth\AuthenticatesUsers;

    class LoginController extends Controller
    {
        /*
        |--------------------------------------------------------------------------
        | Login Controller
        |--------------------------------------------------------------------------
        |
        | This controller handles authenticating users for the application and
        | redirecting them to your home screen. The controller uses a trait
        | to conveniently provide its functionality to your applications.
        |
        */

        use AuthenticatesUsers;

        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->middleware('guest')->except('logout');
        }

        public function redirectTo(): string
        {
            $i = Auth::user()->user_type;
            if ($i == 'regular' || $i === 'premium') {
                $this->redirectTo = '/user/dashboard';
                return $this->redirectTo;
            } elseif ($i == 'admin') {
                $this->redirectTo = RouteServiceProvider::HOME;
                return $this->redirectTo;
            } else {
                $this->redirectTo = '/login';
                return $this->redirectTo;
            }
        }

        public function username(): string
        {
            return 'username';
        }


    }
