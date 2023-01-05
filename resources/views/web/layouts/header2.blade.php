<div class="header-area" id="headerArea">
    <div class="container h-100 d-flex align-items-center justify-content-between">
        <!-- Back Button-->
        <div class="back-button d-flex">
            <a href="{{ route('shop') }}"> <i class="lni lni-arrow-left"></i> </a>
        </div>
        <!-- Page Title-->
        <div class="page-heading">
            <h6 class="mb-0">{{ strtoupper(str_replace('.', ' ', request()->route()->getName())) }}</h6>
        </div>
        <!-- Filter Option-->
        <div class="align-items-center d-flex gap-5 list-unstyled">
            @if(request()->route()->getName() != 'shop.cart')
            <li class="d-lg-block d-none">
                <a href="{{ route('shop.cart') }}" class="position-relative">
                    <i class="lni lni-shopping-basket fs-6 text-dark"></i>
                    <span id="header-cart-count" class="align-items-center d-flex justify-content-center position-absolute header-cart-top-indicator">
                        {{ $cart }}
                    </span>
                </a>
            </li>
            @endif
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
    </div>
</div>
