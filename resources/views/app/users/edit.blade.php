@extends('layouts.app')
@section('title') {{__('crud.users.edit_title')}} @endsection
@section('section-title') {{__('crud.users.edit_title')}} @endsection

@section('section-content')

            <x-form
                method="PUT"
                action="{{ route('users.update', $user) }}"
                has-files
                class="mt-4"
            >
                @include('app.users.form-inputs')

                <div class="mt-4">
                    <a href="{{ route('users.index') }}" class="btn btn-light">
                        <i class="icon fas fa-arrow-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a href="{{ route('users.create') }}" class="btn btn-light">
                        <i class="icon fas fa-plus text-primary"></i>
                        @lang('crud.common.create')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon fas fa-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>




@endsection
