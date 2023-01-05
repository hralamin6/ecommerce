@extends('layouts.app')
@section('title') {{ $user->name }} @endsection
@section('section-title') {{ $user->name }} @endsection
@push('stylesheet')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chocolat/1.0.4/css/chocolat.min.css"
          integrity="sha512-4u7uSCIfP5sPKsFd1zwtaAdS1oUevU/oc0o7zwi8P00RDbYORyPMVA9UBOXCWhPQFFynLj3JAfMZsNdgK5MCoQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endpush
@section('section-content')
    <div class="card">
        <div class="d-flex justify-content-center mb-4 card-img-top">
            <div class="chocolat-parent">
                <a class="chocolat-image" href="{{ asset($user->avatar) }}" title="NID front side">
                    <img width="100" src="{{ asset($user->avatar) }}"/>
                </a>
                <a class="chocolat-image" href="{{ asset($user->nid1) }}" title="NID front side">
                    <img width="100" src="{{ asset($user->nid1) }}"/>
                </a>
                <a class="chocolat-image" href="{{ asset($user->nid2) }}" title="NID back side">
                    <img width="100" src="{{ asset($user->nid2) }}"/>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <p><strong>@lang('crud.users.inputs.name')</strong>:
                        <span>{{ $user->name ?? '-' }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <p><strong>@lang('crud.users.inputs.username')</strong>:
                        <span>{{ $user->username ?? '-' }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <p><strong>@lang('crud.users.inputs.referral')</strong>:
                        <span>{{ $user->referral_user ?? '-' }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <p><strong>@lang('crud.users.inputs.email')</strong>:
                        <span>{{ $user->email ?? '-' }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <p><strong>@lang('crud.users.inputs.phone')</strong>:
                        <span>{{ $user->phone ?? '-' }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <p><strong>@lang('crud.users.inputs.nid')</strong>:
                        <span>{{ $user->nid ?? '-' }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <p><strong>@lang('crud.users.inputs.point')</strong>:
                        <span>{{ $user->point ?? '-' }}</span>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <p><strong>@lang('crud.users.inputs.balance')</strong>:
                        <span>{{ $user->balance ?? '-' }}</span>
                </div>
                <div class="col-12">
                    <p><strong>@lang('crud.users.inputs.Shipping')</strong>:
                        <span>{{ $user->shipping ?? '-' }}</span>
                </div>
                @isset($user->expired_at)
                <div class="col-12">
                    <p><strong>Premium subscription expired at</strong>:
                        <span>{{ optional($user->expired_at)->format('d-m-Y h:i A') ?? '-' }}</span>
                </div>
                @endisset
            </div>
{{--            <div class="mt-4">--}}
{{--                <div class="mb-4">--}}
{{--                    <p><strong>@lang('crud.roles.name')</strong>:--}}
{{--                    <div>--}}
{{--                        @forelse ($user->roles as $role)--}}
{{--                            <div class="badge badge-primary">{{ $role->name }}</div>--}}
{{--                            <br/>--}}
{{--                        @empty - @endforelse--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <div class="mt-4 card-footer">
            <a href="{{ route('users.index') }}" class="btn btn-light">
                <i class="icon fas fa-arrow-left"></i>
                @lang('crud.common.back')
            </a>

            @can('create', App\Models\User::class)
                <a href="{{ route('users.create') }}" class="btn btn-light">
                    <i class="icon fas fa-plus"></i> @lang('crud.common.create')
                </a>
            @endcan
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chocolat/1.0.4/js/chocolat.js"
            integrity="sha512-eSmmmqDnAxRyjIFl1IF64jGk2U2Bkd69gO0xQ+hS6ySPO1kxiaBRPOkhvE9Q+iibh5xQRh4bOu743zTxPe6JvQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {
            Chocolat(document.querySelectorAll('.chocolat-parent .chocolat-image'))
        });

    </script>
@endpush
