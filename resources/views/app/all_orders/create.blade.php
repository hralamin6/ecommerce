@extends('layouts.app')
@section('title') {{__('crud.all_orders.create_title')}} @endsection
@section('section-title') {{__('crud.all_orders.create_title')}} @endsection
@section('section-content')


            <x-form
                method="POST"
                action="{{ route('all-orders.store') }}"
                class="mt-4"
            >
                @include('app.all_orders.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('all-orders.index') }}"
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
