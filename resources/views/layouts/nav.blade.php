<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm p-2">
    <div class="container">

        <a class="navbar-brand text-primary font-weight-bold text-uppercase" href="{{ url('/') }}">
            b2e
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Apps <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @can('view-any', App\Models\User::class)
                        <a class="dropdown-item" href="{{ route('users.index') }}">Users</a>
                        @endcan
                        @can('view-any', App\Models\Category::class)
                        <a class="dropdown-item" href="{{ route('categories.index') }}">Categories</a>
                        @endcan
                        @can('view-any', App\Models\Products::class)
                        <a class="dropdown-item" href="{{ route(products.index') }}">All Products</a>
                        @endcan
                        @can('view-any', App\Models\Reviews::class)
                        <a class="dropdown-item" href="{{ route(reviews.index') }}">All Reviews</a>
                        @endcan
                        @can('view-any', App\Models\Slider::class)
                        <a class="dropdown-item" href="{{ route('sliders.index') }}">Sliders</a>
                        @endcan
                        @can('view-any', App\Models\Orders::class)
                        <a class="dropdown-item" href="{{ route('orders.index') }}">All Orders</a>
                        @endcan
                        @can('view-any', App\Models\Wishlists::class)
                        <a class="dropdown-item" href="{{ route(wishlists.index') }}">All Wishlists</a>
                        @endcan
                        @can('view-any', App\Models\Banners::class)
                        <a class="dropdown-item" href="{{ route(banners.index') }}">All Banners</a>
                        @endcan
                        @can('view-any', App\Models\Coupons::class)
                        <a class="dropdown-item" href="{{ route(coupons.index') }}">All Coupons</a>
                        @endcan
                        @can('view-any', App\Models\Brand::class)
                        <a class="dropdown-item" href="{{ route('brands.index') }}">Brands</a>
                        @endcan
                    </div>

                </li>
                @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) ||
                Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Access Management <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @can('view-any', Spatie\Permission\Models\Role::class)
                        <a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a>
                        @endcan

                        @can('view-any', Spatie\Permission\Models\Permission::class)
                        <a class="dropdown-item" href="{{ route('permissions.index') }}">Permissions</a>
                        @endcan
                    </div>
                </li>
                @endif
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>