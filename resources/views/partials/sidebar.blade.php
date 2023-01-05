<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('home') }}">{{ config('app.name') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('home') }}">{{ strtoupper(substr(config('app.name'), 0, 3)) }}</a>
    </div>
    <ul class="sidebar-menu mb-3">
        @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) ||
     Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
            <li class="menu-header">Access Management</li>
            @can('view-any', Spatie\Permission\Models\Role::class)
                <x-app.side-link class="{{ request()->routeIs('roles.*') ? 'active' : '' }}"
                                 href="{{ route('roles.index') }}"
                                 text="Roles" icon="universal-access"></x-app.side-link>
            @endcan
            @can('view-any', Spatie\Permission\Models\Permission::class)
                <x-app.side-link class="{{ request()->routeIs('permissions.*') ? 'active' : '' }}"
                                 href="{{ route('permissions.index') }}" text="Permissions" icon="low-vision"></x-app.side-link>

            @endcan
        @endif
        <li class="menu-header">Ecommerce</li>
        @can('view-any', App\Models\Orders::class)
            <x-app.side-link class="{{  request()->routeIs('all-orders.*') ? 'active' : ''  }}"
                             href="{{ route('all-orders.index') }}" text="Order Management"
                             icon="shopping-bag"></x-app.side-link>
        @endcan
        @can('view-any', App\Models\Products::class)
            <x-app.side-link class="{{  request()->routeIs('all-products.*') ? 'active' : ''  }}"
                             href="{{ route('all-products.index') }}" text="Product Management"
                             icon="cart-plus"></x-app.side-link>
        @endcan
        @can('view-any', App\Models\Category::class)
            <x-app.side-link class="{{  request()->routeIs('categories.*') ? 'active' : ''  }}"
                             href="{{ route('categories.index') }}" text="Category Management"
                             icon="th-large"></x-app.side-link>
        @endcan
        {{--        @can('view-any', App\Models\Brand::class)--}}
        {{--        <x-app.side-link class="{{  request()->routeIs('brands.*') ? 'active' : ''  }}"--}}
        {{--            href="{{ route('brands.index') }}" text="Brand Management" icon="pencil-ruler">
        </x-app.side-link>--}}
        {{--        @endcan--}}
        @can('view-any', App\Models\Reviews::class)
            <x-app.side-link class="{{  request()->routeIs('all-reviews.*') ? 'active' : ''  }}"
                             href="{{ route('all-reviews.index') }}" text="Review Management"
                             icon="rss"></x-app.side-link>
        @endcan
        <li class="menu-header">B2E Feature</li>
        @can('view-any', App\Models\User::class)
            <x-app.side-link
                class="{{  (request()->routeIs('users.*') || request()->routeIs('upgrade.*')) ? 'active' : ''  }}"
                href="{{ route('users.index') }}" text="User Management" icon="users"></x-app.side-link>
        @endcan
        <x-app.side-link class="{{  request()->routeIs('works.*') ? 'active' : ''  }}" href="{{ route('works.index') }}"
                         text="Work Management" icon="briefcase"></x-app.side-link>
        @can('view-any', App\Models\Brand::class)
            <x-app.side-link class="{{  request()->routeIs('wallet.*') ? 'active' : ''  }}" href="{{ route('wallet') }}"
                             text="Wallet Management" icon="wallet"></x-app.side-link>
        @endcan
        <li class="menu-header">Site Settings</li>
        @can('view-any', App\Models\Slider::class)
            <x-app.side-link class="{{  request()->routeIs('sliders.*') ? 'active' : ''  }}"
                             href="{{ route('sliders.index') }}" text="Slider Management"
                             icon="columns"></x-app.side-link>
        @endcan

        @can('view-any', App\Models\Banners::class)
            <x-app.side-link class="{{  request()->routeIs('all-banners.*') ? 'active' : ''  }}"
                             href="{{ route('all-banners.index') }}" text="Banner Management"
                             icon="images"></x-app.side-link>
        @endcan
        {{--        @can('view-any', App\Models\Coupons::class)--}}
        {{--        <x-app.side-link class="{{  request()->routeIs('all-coupons.*') ? 'active' : ''  }}"--}}
        {{--            href="{{ route('all-coupons.index') }}" text="Coupon Management" icon="dolly-flatbed">
        </x-app.side-link>--}}
        {{--        @endcan--}}


        @can('view-any', App\Models\PaymentMethod::class)
            <x-app.side-link class="{{  request()->routeIs('payment-methods.*') ? 'active' : ''  }}"
                             href="{{ route('payment-methods.index') }}" text="Payment Methods"
                             icon="mobile"></x-app.side-link>
        @endcan

        @can('view-any', App\Models\Districts::class)
            <x-app.side-link class="{{  request()->routeIs('all-districts.*') ? 'active' : ''  }}"
                             href="{{ route('all-districts.index') }}" text="All Districts"
                             icon="images"></x-app.side-link>
        @endcan

        @can('view-any', App\Models\SubDistricts::class)
            <x-app.side-link class="{{  request()->routeIs('all-sub-districts.*') ? 'active' : ''  }}"
                             href="{{ route('all-sub-districts.index') }}" text="All Sub Districts"
                             icon="images"></x-app.side-link>
        @endcan
        <x-app.side-link class="{{  request()->routeIs('settings.page') ? 'active' : ''  }}"
                         href="{{ route('settings.page') }}" text="{{ __('crud.common.settings') }}"
                         icon="pencil-ruler">
        </x-app.side-link>
        {{--    Required pages for sslcommerz    --}}
        @can('terms service', Spatie\Permission\Models\ExtraPage::class)
            <x-app.side-link class="{{  request()->routeIs('admin.terms-conditions') ? 'active' : ''  }}"
                             href="{{ route('admin.terms-conditions') }}" text="{{ __('crud.common.terms_conditions') }}"
                             icon="link">
            </x-app.side-link>
        @endcan
        @can('terms service', Spatie\Permission\Models\ExtraPage::class)
            <x-app.side-link class="{{  request()->routeIs('admin.terms-service') ? 'active' : ''  }}"
                             href="{{ route('admin.terms-service') }}" text="{{ __('crud.common.terms_service') }}"
                             icon="link">
            </x-app.side-link>
        @endcan
        @can('terms service', Spatie\Permission\Models\ExtraPage::class)
            <x-app.side-link class="{{  request()->routeIs('admin.refund-policy') ? 'active' : ''  }}"
                             href="{{ route('admin.refund-policy') }}" text="{{ __('crud.common.refund_policy') }}"
                             icon="link">
            </x-app.side-link>
        @endcan
        @can('terms service', Spatie\Permission\Models\ExtraPage::class)
            <x-app.side-link class="{{  request()->routeIs('admin.privacy-policy') ? 'active' : ''  }}"
                             href="{{ route('admin.privacy-policy') }}" text="{{ __('crud.common.privacy_policy') }}"
                             icon="link">
            </x-app.side-link>
        @endcan
        @can('terms service', Spatie\Permission\Models\ExtraPage::class)
            <x-app.side-link class="{{  request()->routeIs('admin.about-us') ? 'active' : ''  }}"
                             href="{{ route('admin.about-us') }}" text="{{ __('crud.common.about_us') }}"
                             icon="link">
            </x-app.side-link>
        @endcan


    </ul>
</aside>
