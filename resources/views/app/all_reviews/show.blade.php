@extends('layouts.app')
@section('title') {{__('crud.all_reviews.show_title')}} @endsection
@section('section-title') {{__('crud.all_reviews.show_title')}} @endsection
@section('section-content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <p> <strong>@lang('crud.all_reviews.inputs.user_id') </strong> : {{ optional($reviews->user)->name ?? '-' }}</p>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <p> <strong>@lang('crud.all_reviews.inputs.products_id') </strong> :
                    {{ optional($reviews->products)->name ?? '-' }}</p>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <p> <strong>@lang('crud.all_reviews.inputs.rating') </strong> : {{ $reviews->rating ?? '-' }}</p>
            </div>
            <div class="col-12 mb-3">
                <p> <strong>@lang('crud.all_reviews.inputs.comment') </strong> : {{ $reviews->comment ?? '-' }}</p>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 ">
                <p> <strong>@lang('crud.all_reviews.inputs.status') </strong> : {{ $reviews->status ? "Active" :  'Inactive' }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="mt-4 card-footer">
        <a href="{{ route('all-reviews.index') }}" class="btn btn-light">
            <i class="icon fas fa-arrow-left"></i>
            @lang('crud.common.back')
        </a>
    
        @can('create', App\Models\Reviews::class)
        <a href="{{ route('all-reviews.create') }}" class="btn btn-light">
            <i class="icon fas fa-plus"></i> @lang('crud.common.create')
        </a>
        @endcan
    </div>
</div>

@endsection