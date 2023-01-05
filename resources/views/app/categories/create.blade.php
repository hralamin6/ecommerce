@extends('layouts.app')
@section('title') {{__('crud.categories.create_title')}} @endsection
@section('section-title') {{__('crud.categories.create_title')}} @endsection
@section('section-content')


            <x-form
                method="POST"
                action="{{ route('categories.store') }}"
                has-files
                class="mt-4"
            >
                @include('app.categories.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('categories.index') }}"
                        class="btn btn-light"
                    >
                        <i class="icon fas fa-arrow-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon fas fa-save"></i>
                        @lang('crud.common.create')
                    </button>
                </div>
            </x-form>
        
@endsection
