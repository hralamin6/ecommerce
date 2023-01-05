<div class="b2e-sidenav-wrapper" id="sidenavWrapper">
    <!-- Sidenav Profile-->
    <div class="sidenav-profile">
        <div class="user-profile" style="margin-top: 2rem">
            <img
                src="{{ \App\Helper::getUserAvatar() }}"
                alt="">
        </div>
        <div class="user-info">
            <h6 class="user-name mb-0">{{auth()->user()->name ?? "Welcome Guest" }} </h6>
            @auth<p class="mb-2"> {{ '@'.auth()->user()->username }} </p>@endauth
            @guest
                <div class="d-flex gap-3 pt-3 text-start justify-content-center">
                    <a class="btn btn-danger btn-sm" href="{{ route('b2e.login') }}">Sign in</a>
                    <a class="btn btn-outline-light btn-sm" href="{{ route('b2e.signup') }}">Sign Up</a>
                </div>
            @endguest
            @premium
                <div>
                    <button class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="E-Balance">
                        {{auth()->user()->point}}
                    </button>
                    <button class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="I-Balance">
                        @taka(auth()->user()->balance)
                    </button>
                </div>
                <div>
                    <div class="card-body d-flex gap-1 justify-content-between">
                        <div class="align-items-center d-flex flex-column gap-2 justify-content-center">
                            <a href="{{ route('b2e.withdraw.form') }}"
                               class="badge-danger align-content-center align-items-center d-fle d-flex justify-content-center"
                               style="background: rgba(98,54,255,0.1);border-radius: 1em;height: 30px;width: 30px;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.7099 11.29C17.617 11.1963 17.5064 11.1219 17.3845 11.0711C17.2627 11.0203 17.132 10.9942 16.9999 10.9942C16.8679 10.9942 16.7372 11.0203 16.6154 11.0711C16.4935 11.1219 16.3829 11.1963 16.2899 11.29L12.9999 14.59V7C12.9999 6.73478 12.8946 6.48043 12.707 6.29289C12.5195 6.10536 12.2652 6 11.9999 6C11.7347 6 11.4804 6.10536 11.2928 6.29289C11.1053 6.48043 10.9999 6.73478 10.9999 7V14.59L7.70994 11.29C7.52164 11.1017 7.26624 10.9959 6.99994 10.9959C6.73364 10.9959 6.47825 11.1017 6.28994 11.29C6.10164 11.4783 5.99585 11.7337 5.99585 12C5.99585 12.2663 6.10164 12.5217 6.28994 12.71L11.2899 17.71C11.385 17.801 11.4972 17.8724 11.6199 17.92C11.7396 17.9729 11.8691 18.0002 11.9999 18.0002C12.1308 18.0002 12.2602 17.9729 12.3799 17.92C12.5027 17.8724 12.6148 17.801 12.7099 17.71L17.7099 12.71C17.8037 12.617 17.8781 12.5064 17.9288 12.3846C17.9796 12.2627 18.0057 12.132 18.0057 12C18.0057 11.868 17.9796 11.7373 17.9288 11.6154C17.8781 11.4936 17.8037 11.383 17.7099 11.29Z"
                                        fill="#fff"/>
                                </svg>
                            </a>
                            <div style="font-size: 0.8em;" class="text-white fw-bold">Withdraw</div>
                        </div>
                        <div class="align-items-center d-flex flex-column gap-2 justify-content-center">
                            <a href="{{ route('b2e.send.money.form') }}"
                               class="align-content-center align-items-center d-fle d-flex justify-content-center"
                               style="background: #00a802;border-radius: 1em;height: 30px;width: 30px;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.92 11.62C17.8724 11.4972 17.801 11.3851 17.71 11.29L12.71 6.29C12.6168 6.19676 12.5061 6.1228 12.3842 6.07234C12.2624 6.02188 12.1319 5.99591 12 5.99591C11.7337 5.99591 11.4783 6.10169 11.29 6.29C11.1968 6.38324 11.1228 6.49393 11.0723 6.61575C11.0219 6.73757 10.9959 6.86814 10.9959 7C10.9959 7.2663 11.1017 7.52169 11.29 7.71L14.59 11H7C6.73478 11 6.48043 11.1054 6.29289 11.2929C6.10536 11.4804 6 11.7348 6 12C6 12.2652 6.10536 12.5196 6.29289 12.7071C6.48043 12.8946 6.73478 13 7 13H14.59L11.29 16.29C11.1963 16.383 11.1219 16.4936 11.0711 16.6154C11.0203 16.7373 10.9942 16.868 10.9942 17C10.9942 17.132 11.0203 17.2627 11.0711 17.3846C11.1219 17.5064 11.1963 17.617 11.29 17.71C11.383 17.8037 11.4936 17.8781 11.6154 17.9289C11.7373 17.9797 11.868 18.0058 12 18.0058C12.132 18.0058 12.2627 17.9797 12.3846 17.9289C12.5064 17.8781 12.617 17.8037 12.71 17.71L17.71 12.71C17.801 12.6149 17.8724 12.5027 17.92 12.38C18.02 12.1365 18.02 11.8635 17.92 11.62Z"
                                        fill="#fff"/>
                                </svg>
                            </a>
                            <div style="font-size: 0.8em;" class="text-white fw-bold">Send</div>
                        </div>
                        <div class="align-items-center d-flex flex-column gap-2 justify-content-center">
                            <a href=""
                               class="badge-success align-content-center align-items-center d-fle d-flex justify-content-center"
                               style="background: rgba(98,54,255,0.1);border-radius: 1em;height: 30px;width: 30px;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 20H4C2.89543 20 2 19.1046 2 18V6C2 4.89543 2.89543 4 4 4H20C21.1046 4 22 4.89543 22 6V18C22 19.1046 21.1046 20 20 20ZM4 12V18H20V12H4ZM4 6V8H20V6H4ZM13 16H6V14H13V16Z"
                                        fill="#fff"/>
                                </svg>
                            </a>
                            <div style="font-size: 0.8em;" class="text-white fw-bold">Cards</div>
                        </div>
                        <div class="align-items-center d-flex flex-column gap-2 justify-content-center">
                            <a href="{{ route('b2e.exchange.form') }}"
                               class="badge-warning align-content-center align-items-center d-fle d-flex justify-content-center"
                               style="background: rgba(98,54,255,0.1);border-radius: 1em;height: 30px;width: 30px;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 22L3 18L7 14V17H17V13H19V18C19 18.5523 18.5523 19 18 19H7V22ZM7 11H5V6C5 5.44772 5.44772 5 6 5H17V2L21 6L17 10V7H7V11Z"
                                        fill="#fff"/>
                                </svg>
                            </a>
                            <div style="font-size: 0.8em;" class="text-white fw-bold">Exchange</div>
                        </div>
                    </div>
                </div>
            @endpremium

        </div>
    </div>
    <!-- Sidenav Nav-->
    <ul class="sidenav-nav ps-0" style="margin-top: 0.2rem">
        @auth
            <li>
                <a href="{{ route('profile') }}"><i class="lni lni-user"></i>My Profile</a>
            </li>
            <li>
                <a href="{{ route('b2e.my-orders') }}"><i class="lni lni-bi-cycle"></i>My Orders</a>
            </li>
            @premium
                <li>
                    <a href="{{ route('b2e.my-accounts') }}"><i class="lni lni-list"></i>Other Accounts</a>
                </li>
                <li>
                    <a href="{{ route('b2e.my-teams') }}"><i class="lni lni-users"></i>My Team</a>
                </li>
                <li>
                    <a href="{{ route('b2e.works') }}"><i class="lni lni-briefcase"></i>My Works</a>
                </li>
                <li>
                    <a href="{{ route('b2e.wallet') }}"><i class="lni lni-wallet"></i>My Wallet</a>
                </li>
            @endpremium
            @if(auth()->user()->user_type == 'regular' && !auth()->user()->is_pending)
                <li><a href="{{ route('b2e.upgradeToPro') }}" class="btn btn-danger"><i class="lni lni-unlock"></i>Upgrade
                        to Premium</a></li>
            @endif
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                    <i class="lni lni-power-switch"></i>
                    Sign Out
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endauth
            <li>
                <a href="{{ route('terms-conditions') }}"><i class="lni lni-link"></i>Terms conditions</a>
                <a href="{{ route('terms-service') }}"><i class="lni lni-link"></i>Terms service</a>
                <a href="{{ route('refund-policy') }}"><i class="lni lni-link"></i>Tefund policy</a>
                <a href="{{ route('privacy-policy') }}"><i class="lni lni-link"></i>Privacy policy</a>
                <a href="{{ route('about-us') }}"><i class="lni lni-link"></i>About us</a>
            </li>
    </ul>
    <!-- Go Back Button-->
    <div class="go-home-btn" id="goHomeBtn"><i class="lni lni-arrow-left"></i></div>
</div>
