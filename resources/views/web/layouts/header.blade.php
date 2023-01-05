<div class="header-area" id="headerArea">
    <div class="container h-100 d-flex align-items-center justify-content-between">
        <!-- Logo Wrapper-->
        <div class="logo-wrapper"><a href="/"><img style="height: 48px; object-fit: contain;" src="{{ asset('frontend/img/core-img/logo-b2e-final.jpg')}}" alt=""></a></div>
        <!-- Search Form-->
        <div class="top-search-form">
            <form>
                <input class="form-control" type="search" placeholder="Enter your keyword" name="search"
                       value="{{ request('search') ?? '' }}">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="align-items-center d-flex gap-5 list-unstyled">
            <li class="d-lg-block d-none">
                <a href="{{ route('shop.cart') }}" class="position-relative">
                    <i class="lni lni-shopping-basket fs-6 text-dark"></i>
                    <span id="header-cart-count" class="align-items-center d-flex justify-content-center position-absolute header-cart-top-indicator">
                        {{ $cart }}
                    </span>
                </a>
            </li>
            <li class="d-lg-block d-none">
                 <a href="{{ route('b2e.wishlist') }}" class="position-relative">
                    <i class="lni lni-heart fs-6 text-dark"></i>
                    <span id="header-wish-count" class="align-items-center d-flex justify-content-center position-absolute header-cart-top-indicator">
                        {{ $wish }}
                    </span>
                </a>
            </li>
            <div class="b2e-navbar-toggler d-flex flex-wrap" id="b2eNavbarToggler">
                <span></span><span></span><span></span>
            </div>
        </div>
        <!-- Navbar Toggler-->

    </div>
</div>
