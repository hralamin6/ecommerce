@extends('layouts.app')
@section('title') {{__('crud.sliders.show_title')}} @endsection
@section('section-title') {{$slider->title}} @endsection
@section('section-content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="card-img">
                <img class="mw-100 img-thumbnail" src="{{ $slider->image ? asset($slider->image) : '' }}" alt="{{$slider->title}}">

            </div>          
            <div class="card-body ">
                <div class="mb-4">
                    <p><strong>@lang('crud.sliders.inputs.title')</strong> :
                    <span>{{ $slider->title ?? '-' }}</span>
                    </p>
                </div>
                <div class="mb-4">
                    <p><strong>@lang('crud.sliders.inputs.subtitle')</strong> :
                    <span>{{ $slider->subtitle ?? '-' }}</span>
                    </p>
                </div>
                <div class="mb-4">
                    <p><strong>@lang('crud.sliders.inputs.action')</strong> :
                    <span>{{ $slider->action ?? '-' }}</span>
                    </p>
                </div>                
                <div class="mb-4">
                    <p><strong>@lang('crud.sliders.inputs.status')</strong> :
                    <span>{{ $slider->status ? "Active" : "Inactive" }}</span>
                    </p>
                </div>
            </div>

            <div class="mt-4 card-footer">
                <a href="{{ route('sliders.index') }}" class="btn btn-light">
                    <i class="icon fas fa-arrow-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Slider::class)
                <a href="{{ route('sliders.create') }}" class="btn btn-light">
                    <i class="icon fas fa-plus"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
