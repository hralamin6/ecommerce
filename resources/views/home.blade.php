@extends('layouts.app') @section('title', 'Admin Dashboard')
@section('section-title','Dashboard Information') @section('section-content')
<h5>Users</h5>
<hr />
<div class="row">
    {{--        @if (Auth::user()->isSuperAdmin())--}}
    {{--
    <x-dashcard
        icon="dollar-sign"
        title="Admin Wallet Balance"
        count="{{ $admin_balance }}"
    ></x-dashcard
    >--}}
    {{--        @endif--}}
    <x-dashcard
        icon="users"
        title="Total User"
        count="{{ $total_user }}"
    ></x-dashcard>
    <x-dashcard
        icon="user-tie"
        title="Total User (Premium)"
        count="{{ $total_user_premium }}"
    ></x-dashcard>
    <x-dashcard
        icon="user-tie"
        title="Total Pending Premium"
        count="{{ $total_user_premium_pending }}"
    ></x-dashcard>
    <x-dashcard
        icon="dollar-sign"
        title="Total User Wallet Balance"
        count="{{ $total_user_balance }}"
    ></x-dashcard>
</div>
<h5>Shop</h5>
<hr />
<div class="row">
    {{--
    <x-dashcard
        icon="tags"
        title="Total Brands"
        count="{{ $total_brands }}"
    ></x-dashcard
    >--}}
    <x-dashcard
        icon="swatchbook"
        title="Total Categories"
        count="{{ $total_category }}"
    ></x-dashcard>
    <x-dashcard
        icon="boxes"
        title="Total Products"
        count="{{ $total_products }}"
    ></x-dashcard>
</div>
<h5>Orders</h5>
<hr />
<div class="row">
    <x-dashcard
        icon="truck-loading"
        title="Total Order"
        count="{{ $total_orders }}"
    ></x-dashcard>
    <x-dashcard
        icon="truck-loading"
        title="Total Canceled Order"
        count="{{ $total_orders_canceled }}"
    ></x-dashcard>
    <x-dashcard
        icon="truck-loading"
        title="Total Accepted Order"
        count="{{ $total_orders_accepted }}"
    ></x-dashcard>
    <x-dashcard
        icon="truck-loading"
        title="Total Processing Order"
        count="{{ $total_orders_processing }}"
    ></x-dashcard>
    <x-dashcard
        icon="truck-loading"
        title="Total Delivered Order"
        count="{{ $total_orders_delivered }}"
    ></x-dashcard>
</div>

@endsection
