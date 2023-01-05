@extends('layouts.app')
@section('title') {{__('crud.brands.index_title')}} @endsection
@section('section-title') {{__('crud.brands.index_title')}} @endsection
@section('section-content')
<x-app.table>
    <x-slot name="search">{{ $search ?? "" }}</x-slot>
    <x-slot name="create">
        @can('create', App\Models\Brands::class)
            <a
                    href="{{ route('brands.create') }}"
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
            @lang('crud.brands.inputs.name')
        </th>
        <th class="text-left">
            @lang('crud.brands.inputs.slug')
        </th>
        <th class="text-left">
            @lang('crud.brands.inputs.logo')
        </th>
        <th class="text-left">
            @lang('crud.brands.inputs.status')
        </th>
        <th class="text-center">
            @lang('crud.common.actions')
        </th>
    </tr>
    </thead>
    <tbody>
    @forelse($brands as $brand)
        <tr>
            <td>{{ $brand->name ?? '-' }}</td>
            <td>{{ $brand->slug ?? '-' }}</td>
            <td>
                <x-partials.thumbnail
                    src="{{ $brand->logo ? asset($brand->logo) : '' }}"
                />
            </td>
            <td>{{ $brand->status ? "Active" : "Inactive" }}</td>
            <td class="text-center" style="width: 134px;">
                <div
                        role="group"
                        aria-label="Row Actions"
                        class="btn-group"
                >
                    @can('update', $brand)
                        <a
                                href="{{ route('brands.edit', $brand) }}"
                        >
                            <button
                                    type="button"
                                    class="btn btn-light"
                            >
                                <i class="icon fas fa-edit fa-sm"></i>
                            </button>
                        </a>
                    @endcan @can('view', $brand)
                        <a
                                href="{{ route('brands.show', $brand) }}"
                        >
                            <button
                                    type="button"
                                    class="btn btn-light"
                            >
                                <i class="icon fas fa-eye fa-sm"></i>
                            </button>
                        </a>
                    @endcan @can('delete', $brand)
                        <form
                                action="{{ route('brands.destroy', $brand) }}"
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
        {!! $brands->render() !!}
    </x-slot>
</x-app.table>
@endsection
