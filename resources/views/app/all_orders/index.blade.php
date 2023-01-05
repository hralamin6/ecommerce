@extends('layouts.app')
@section('title') {{__('crud.all_orders.index_title')}} @endsection
@section('section-title') {{__('crud.all_orders.index_title')}} @endsection
@section('section-content')
<x-app.table>
    <x-slot name="search">{{ $search ?? "" }}</x-slot>

    <thead>
    <tr>
        <th class="text-left">
           SL.
        </th>
        <th class="text-left">
            @lang('crud.all_orders.inputs.user_id')
        </th>
        <th class="text-left">
            @lang('crud.all_orders.inputs.code')
        </th>
        <th class="text-left">
            @lang('crud.all_orders.inputs.delivery_status')
        </th>
        <th class="text-left">
            @lang('crud.all_orders.inputs.payment_type')
        </th>
        <th class="text-left">
            @lang('crud.all_orders.inputs.payment_status')
        </th>
        <th class="text-left">
            @lang('crud.all_orders.inputs.grand_total')
        </th>

        <th class="text-left">
            @lang('crud.all_orders.inputs.shipping_cost')
        </th>
        <th class="text-left">
            @lang('crud.all_orders.inputs.shipping_address')
        </th>


        <th class="text-center">
            @lang('crud.common.actions')
        </th>
    </tr>
    </thead>
    <tbody>
    @forelse($allOrders as $orders)
        <tr>
            <td>{{ $orders->id }}</td>
            <td>{{ optional($orders->user)->name ?? '-' }}</td>
            <td>{{ $orders->code ?? '-' }}</td>
            <td>
                {{ $orders->delivery_status ?? '-' }} <br>

            </td>
            <td>{{ $orders->payment_type ?? '-' }}</td>
            <td>{{ $orders->payment_status ?? '-' }}</td>
            <td>{{ $orders->grand_total ?? '-' }}</td>

            <td>{{ $orders->shipping_cost ?? '-' }}</td>
            <td>
                {!!  $orders->shipping_address ?? '-' !!} <br>
                {{ $orders->shipping_district ?? '-' }} <br>

            </td>

            <td class="text-center" style="width: 134px;">
                <div
                        role="group"
                        aria-label="Row Actions"
                        class="btn-group"
                >
                    @can('update', $orders)
                        <a
                                href="{{ route('all-orders.edit', $orders) }}"
                        >
                            <button
                                    type="button"
                                    class="btn btn-light"
                            >
                                <i class="icon fas fa-edit fa-sm"></i>
                            </button>
                        </a>
                    @endcan @can('view', $orders)
                        <a
                                href="{{ route('all-orders.show', $orders) }}"
                        >
                            <button
                                    type="button"
                                    class="btn btn-light"
                            >
                                <i class="icon fas fa-eye fa-sm"></i>
                            </button>
                        </a>
                    @endcan @can('delete', $orders)
                        <form
                                action="{{ route('all-orders.destroy', $orders) }}"
                                method="POST"
                                onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                        >
                            @csrf @method('DELETE')
                            <button
                                    type="submit"
                                    class="btn btn-light text-danger"
                            >
                                <i class="icon fas fa-trash fa-sm"></i>
                            </button>
                        </form>
                    @endcan
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="14">
                @lang('crud.common.no_items_found')
            </td>
        </tr>
    @endforelse
    </tbody>
    <x-slot name="pagination">
        {!! $allOrders->render() !!}
    </x-slot>
</x-app.table>
@endsection
