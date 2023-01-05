@extends('layouts.app')
@section('title') {{__('crud.roles.edit_title')}} @endsection
@section('section-title') {{__('crud.roles.edit_title')}} @endsection
@section('section-content')
<div class="container">
    <div class="card">
        <div class="card-body">
            {{-- <h4 class="card-title">
                <a href="{{ route('roles.index') }}" class="mr-4"
                    ><i class="icon fas fa-arrow-back"></i
                ></a>
                @lang('crud.roles.edit_title') 
            </h4> --}}

            <x-form
                method="PUT"
                action="{{ route('roles.update', $role) }}"
                class="mt-4"
            >
                @include('app.roles.form-inputs')

                <div class="mt-4">
                    <a href="{{ route('roles.index') }}" class="btn btn-light">
                        <i class="icon fas fa-arrow-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a href="{{ route('roles.create') }}" class="btn btn-light">
                        <i class="icon fas fa-plus text-primary"></i>
                        @lang('crud.common.create')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon fas fa-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
