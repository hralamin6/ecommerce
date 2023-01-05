@extends('layouts.app')
@section('title', __('crud.payment_methods.edit_title'))
@section('section-title', __('crud.payment_methods.edit_title'))
@section('section-content')

            <x-form
                method="PUT"
                action="{{ route('payment-methods.update', $paymentMethod) }}"
                class="mt-4"
            >
                @include('app.payment_methods.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('payment-methods.index') }}"
                        class="btn btn-light"
                    >
                        <i class="fas fa-arrow-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a
                        href="{{ route('payment-methods.create') }}"
                        class="btn btn-light"
                    >
                        <i class="fas fa-plus text-primary"></i>
                        @lang('crud.common.create')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>

@endsection
