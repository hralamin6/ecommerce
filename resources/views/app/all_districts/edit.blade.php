@extends('layouts.app')
@section('title') {{__('crud.all_districts.edit_title')}} @endsection
@section('section-title') {{__('crud.all_districts.edit_title')}} @endsection
@section('section-content')


            <x-form
                method="PUT"
                action="{{ route('all-districts.update', $districts) }}"
                class="mt-4"
            >
                @include('app.all_districts.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('all-districts.index') }}"
                        class="btn btn-light"
                    >
                        <i class="fas fa-arrow-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>



                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>

@endsection
