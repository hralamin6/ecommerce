@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('works.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.works.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.works.inputs.url')</h5>
                    <span>{{ $work->url ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.works.inputs.notes')</h5>
                    <span>{{ $work->notes ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.works.inputs.status')</h5>
                    <span>{{ $work->status ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('works.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Work::class)
                <a href="{{ route('works.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
