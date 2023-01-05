@extends('layouts.app')
@section('title', __('crud.districts_all_sub_districts.edit_title'))
@section('section-title', __('crud.districts_all_sub_districts.edit_title'))
@section('section-content')


            <x-form
                method="PUT"
                action="{{ route('all-sub-districts.update', $subDistricts) }}"
                class="mt-4"
            >
                @include('app.all_sub_districts.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('all-sub-districts.index') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a
                        href="{{ route('all-sub-districts.create') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-add text-primary"></i>
                        @lang('crud.common.create')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>

@endsection
