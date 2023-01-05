@extends('layouts.app')
@section('title') {{__('crud.all_coupons.index_title')}} @endsection
@section('section-title') {{__('crud.all_coupons.index_title')}} @endsection
@section('section-content')
    <x-app.table>
        <x-slot name="search">{{ $search ?? "" }}</x-slot>
        <x-slot name="create">
            @can('create', App\Models\Coupons::class)
                <a
                        href="{{ route('all-coupons.create') }}"
                        class="btn btn-primary"
                >
                    <i class="icon fas fa-plus"></i>
                    @lang('crud.common.create')
                </a>
            @endcan
        </x-slot>
        <thead>
        <tr>
            <th class="text-left">
                @lang('crud.all_coupons.inputs.code')
            </th>
            <th class="text-right">
                @lang('crud.all_coupons.inputs.discount')
            </th>
            <th class="text-left">
                @lang('crud.all_coupons.inputs.discount_type')
            </th>
            <th class="text-left">
                @lang('crud.all_coupons.inputs.start')
            </th>
            <th class="text-left">
                @lang('crud.all_coupons.inputs.end')
            </th>
            <th class="text-center">
                @lang('crud.common.actions')
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($allCoupons as $coupons)
            <tr>
                <td>{{ $coupons->code ?? '-' }}</td>
                <td>{{ $coupons->discount ?? '-' }}</td>
                <td>{{ $coupons->discount_type ?? '-' }}</td>
                <td>{{ $coupons->start ?? '-' }}</td>
                <td>{{ $coupons->end ?? '-' }}</td>
                <td class="text-center" style="width: 134px;">
                    <div
                            role="group"
                            aria-label="Row Actions"
                            class="btn-group"
                    >
                        @can('update', $coupons)
                            <a
                                    href="{{ route('all-coupons.edit', $coupons) }}"
                            >
                                <button
                                        type="button"
                                        class="btn btn-light"
                                >
                                    <i class="icon fas fa-edit fa-sm"></i>
                                </button>
                            </a>
                        @endcan @can('view', $coupons)
                            <a
                                    href="{{ route('all-coupons.show', $coupons) }}"
                            >
                                <button
                                        type="button"
                                        class="btn btn-light"
                                >
                                    <i class="icon fas fa-eye fa-sm"></i>
                                </button>
                            </a>
                        @endcan @can('delete', $coupons)
                            <form
                                    action="{{ route('all-coupons.destroy', $coupons) }}"
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
                <td colspan="6">
                    @lang('crud.common.no_items_found')
                </td>
            </tr>
        @endforelse
        </tbody>
        <x-slot name="pagination">
            {!! $allCoupons->render() !!}
        </x-slot>
    </x-app.table>

@endsection
