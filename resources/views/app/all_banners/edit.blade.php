@extends('layouts.app')
@section('title') {{__('crud.all_banners.edit_title')}} @endsection
@section('section-title'){{$banners->title}} @endsection
@section('section-content')


            <x-form
                method="PUT"
                action="{{ route('all-banners.update', $banners) }}"
                has-files
                class="mt-4"
            >
                @include('app.all_banners.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('all-banners.index') }}"
                        class="btn btn-light"
                    >
                        <i class="icon fas fa-arrow-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a
                        href="{{ route('all-banners.create') }}"
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
