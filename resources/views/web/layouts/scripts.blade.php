<div class="d-lg-none footer-nav-area" id="footerNav">
    <div class="container h-100 px-0">
        <div class="b2e-footer-nav h-100">
            <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
                <li class="{{ request()->routeIs('shop.cart') ? 'active' : null }}">
                    <a href="{{ route('shop.cart') }}">
                        <i class="lni lni-shopping-basket position-relative"></i>
                        Cart
                        <span id="cart-count-footer"
                            class="align-items-center d-flex justify-content-center position-absolute cart-top-indicator">
                            {{ $cart }}
                        </span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('shop') ? 'active' : null }}">
                    <a href="{{ route('shop') }}">
                        <i class="lni lni-home"></i>Home </a>
                </li>
                <li class="{ request()->routeIs('b2e.wishlist') ? 'active' : null }}">
                    <a href="{{ route('b2e.wishlist') }}">
                        <i class="lni lni-heart"></i>
                        Wishlist
                        <span
                            class="align-items-center d-flex justify-content-center position-absolute cart-top-indicator"
                            id="wish-count-footer">
                            {{ $wish }}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>