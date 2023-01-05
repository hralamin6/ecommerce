@extends('layouts.app')
@section('title') {{__('crud.users.index_title')}} @endsection
@section('section-title') {{__('crud.users.index_title')}} @endsection
@section('section-content')

    <div class="card">
        <div class="card-body">           

            <div class="mt-4">
                <div class="mb-4">
                    <p><strong>@lang('crud.roles.inputs.name')</strong> :
                    <span class="text-capitalize">{{ $role->name ?? '-' }}</span></p>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('roles.index') }}" class="btn btn-light">
                    <i class="icon fas fa-arrow-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Role::class)
                <a href="{{ route('roles.create') }}" class="btn btn-light">
                    <i class="icon fas fa-plus"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
