@extends('layouts.app')
@section('title') {{__('crud.categories.edit_title')}} @endsection
@section('section-title') {{__('crud.categories.edit_title')}} @endsection
@section('section-content')


            <x-form
                method="PUT"
                action="{{ route('categories.update', $category) }}"
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

                    <a
                        href="{{ route('categories.create') }}"
                        class="btn btn-light"
                    >
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
