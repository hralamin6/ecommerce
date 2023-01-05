@extends('layouts.app')
@section('title') {{__('crud.all_banners.index_title')}} @endsection
@section('section-title') {{__('crud.all_banners.index_title')}} @endsection
@section('section-content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-banners.index') }}" class="mr-4"
                    ><i class="icon fas fa-arrow-back"></i
                ></a>
                @lang('crud.all_banners.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.all_banners.inputs.title')</h5>
                    <span>{{ $banners->title ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_banners.inputs.sub_title')</h5>
                    <span>{{ $banners->sub_title ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_banners.inputs.url')</h5>
                    <span>{{ $banners->url ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_banners.inputs.position')</h5>
                    <span>{{ $banners->position ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_banners.inputs.photo')</h5>
                    <x-partials.thumbnail
                        src="{{ $banners->photo ? asset($banners->photo) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_banners.inputs.status')</h5>
                    <span>{{ $banners->status ? "Active" : "Inactive" }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('all-banners.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon fas fa-arrow-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Banners::class)
                <a
                    href="{{ route('all-banners.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon fas fa-plus"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
