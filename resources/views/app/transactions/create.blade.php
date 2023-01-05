@extends('layouts.app')
@section('title') {{__('crud.transactions.create_title')}} @endsection
@section('section-title') {{__('crud.transactions.create_title')}} @endsection
@section('section-content')
    <x-form
            method="POST"
            action="{{ route('transactions.store') }}"
            class="mt-4"
    >
        @include('app.transactions.form-inputs')

        <div class="mt-4">
            <a
                    href="{{ route('transactions.index') }}"
                    class="btn btn-light"
            >
                <i class="icon ion-md-return-left text-primary"></i>
                @lang('crud.common.back')
            </a>

            <button type="submit" class="btn btn-primary float-right">
                <i class="icon ion-md-save"></i>
                @lang('crud.common.create')
            </button>
        </div>
    </x-form>
@endsection
