@extends('layouts.app')
@section('title') {{__('crud.payment_methods.index_title')}} @endsection
@section('section-title') {{__('crud.payment_methods.index_title')}} @endsection
@section('section-content')
    <div class="row">
        <div class="col-lg-4">
            <x-form
                method="POST"
                action="{{ route('payment-methods.store') }}"
                class="mt-4"
            >
                @include('app.payment_methods.form-inputs')

                <div class="mt-4">

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-save"></i>
                        @lang('crud.common.create')
                    </button>
                </div>
            </x-form>
        </div>
        <div class="col-lg-8">
            <x-app.table>
                <x-slot name="search">{{ $search ?? "" }}</x-slot>
                <thead>
                <tr>
                    <th class="text-left">
                        @lang('crud.payment_methods.inputs.number')
                    </th>
                    <th class="text-left">
                        @lang('crud.payment_methods.inputs.type')
                    </th>
                    <th class="text-left">
                        @lang('crud.payment_methods.inputs.status')
                    </th>
                    <th class="text-center">
                        @lang('crud.common.actions')
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($paymentMethods as $paymentMethod)
                    <tr>
                        <td>{{ $paymentMethod->number ?? '-' }}</td>
                        <td>{{ $paymentMethod->type ?? '-' }}</td>
                        <td>{{ $paymentMethod->status ?'Yes': 'No' }}</td>
                        <td class="text-center" style="width: 134px;">
                            <div
                                role="group"
                                aria-label="Row Actions"
                                class="btn-group"
                            >
                                @can('update', $paymentMethod)
                                    <a
                                        href="{{ route('payment-methods.edit', $paymentMethod) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                @endcan @can('delete', $paymentMethod)
                                    <form
                                        action="{{ route('payment-methods.destroy', $paymentMethod) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            @lang('crud.common.no_items_found')
                        </td>
                    </tr>
                @endforelse
                </tbody>
                <x-slot name="pagination">
                    {!! $paymentMethods->render() !!}
                </x-slot>
            </x-app.table>
        </div>
    </div>


@endsection
