@extends('layouts.app')
@section('title') {{$user->name}} @endsection
@section('section-title') {{$user->name}} @endsection
@section('title-action')
    <button id="approve-upgrade" class="btn btn-primary ml-auto">Approve</button>
    <button id="cancel-upgrade" class="btn btn-danger ml-2">Cancel</button>
@endsection
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
                    <p><strong>@lang('crud.users.inputs.username')</strong>:
                        <span>{{ $user->username ?? '-' }}</span></p>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <p><strong>@lang('crud.users.inputs.referral')</strong>:
                        <span>{{ $user->referral_user ?? '-' }}</span></p>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <p><strong>@lang('crud.users.inputs.email')</strong>:
                        <span>{{ $user->email ?? '-' }}</span></p>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <p><strong>@lang('crud.users.inputs.nid')</strong>:
                        <span>{{ $user->nid ?? '-' }}</span></p>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <p><strong>@lang('crud.users.inputs.phone')</strong>:
                        <span>{{ $user->phone ?? '-' }}</span></p>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <p><strong>@lang('crud.users.inputs.user_type')</strong>:
                        <span>{{ $user->user_type ?? '-' }}</span></p>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <p><strong>@lang('crud.users.inputs.point')</strong>:
                        <span>{{ $user->point ?? '-' }}</span></p>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <p><strong>@lang('crud.users.inputs.balance')</strong>:
                        <span>{{ $user->balance ?? '-' }}</span></p>
                </div>
                <div class="col-12">
                    <p><strong>@lang('crud.users.inputs.Shipping')</strong>:
                        <span>{{ $user->shipping ?? '-' }}</span></p>
                </div>
            </div>
            {!! $transactions->note ?? "-" !!}
        </div>
        <div class="mt-4 card-footer">
            <a href="{{ route('upgrade.list') }}" class="btn btn-light">
                <i class="icon fas fa-arrow-left"></i>
                @lang('crud.common.back')
            </a>

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
        $("#approve-upgrade").on('click', event => {
            event.preventDefault();
            let id = "{{ $user->id }}";
            let url = "{{route('upgrade.approve', ['user'=>'user_id']) }}";
            $.get(url.replace('user_id', id)).done(response => {
                notyf.success(response.message);location.replace("{{ route('upgrade.list') }}");
            }).fail(error => {
                notyf.error(JSON.parse(error.responseText).message);
            });
        })
        $("#cancel-upgrade").on('click', event => {
            event.preventDefault();
            let id = "{{ $user->id }}";
            let url = "{{route('upgrade.cancel', ['user'=>'user_id']) }}";
            $.get(url.replace('user_id', id)).done(response => {
                notyf.success(response.message);location.replace("{{ route('users.index') }}");
            }).fail(error => {
                notyf.error(JSON.parse(error.responseText).message);
            });
        })
    </script>
@endpush
