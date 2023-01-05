@extends('layouts.app')
@section('title') {{__('crud.categories.show_title')}} @endsection
@section('section-title') {{__('crud.categories.show_title')}} @endsection
@section('section-content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <p> <strong>@lang('crud.categories.inputs.name')</strong> :
                    <span>{{ $category->name ?? '-' }}</span>
                    </p>
                </div>
                <div class="col-12 col-sm-6">
                    <p><strong>@lang('crud.categories.inputs.status')</strong> :
                    <span>{{ $category->status ? "Active" : "Inactive" }}</span>
                    </p>
                </div>
                <div class="col-12 col-sm-8">
                    <h5>@lang('crud.categories.inputs.banner')</h5>
                    <x-partials.thumbnail
                        src="{{ $category->banner ? asset($category->banner) : '' }}"
                        size="150"
                    />
                </div>
                <div class="col-12 col-sm-4">
                    <h5>@lang('crud.categories.inputs.image')</h5>
                    <x-partials.thumbnail
                        src="{{ $category->image ? asset($category->image) : '' }}"
                        size="150"
                    />
                </div>


            </div>

            <div class="mt-4">
                <a href="{{ route('categories.index') }}" class="btn btn-light">
                    <i class="icon fas fa-arrow-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Category::class)
                <a
                    href="{{ route('categories.create') }}"
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
