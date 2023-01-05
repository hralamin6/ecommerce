@extends('layouts.app')
@section('title') {{__('crud.categories.index_title')}} @endsection
@section('section-title') {{__('crud.categories.index_title')}} @endsection
@section('section-content')

    <x-app.table>
        <x-slot name="search">{{ $search ?? "" }}</x-slot>
        <x-slot name="create">
            @can('create', App\Models\Category::class)
                <a
                    href="{{ route('categories.create') }}"
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
                @lang('crud.categories.inputs.name')
            </th>
            <th class="text-left">
                @lang('crud.categories.inputs.banner')
            </th>
            <th class="text-left">
                @lang('crud.categories.inputs.image')
            </th>
            <th class="text-left">
                @lang('crud.categories.inputs.status')
            </th>
            <th class="text-center">
                @lang('crud.common.actions')
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
            <tr>
                <td>
                    {{ $category->category ? $category->category->name . ' > ' : null }}  {{ $category->name ?? '-' }}
                </td>
                <td>
                    <x-partials.thumbnail
                        src="{{ $category->banner ? asset($category->banner) : '' }}"
                    />
                </td>
                <td>
                    <x-partials.thumbnail
                        src="{{ $category->image ? asset($category->image) : '' }}"
                    />
                </td>
                <td>{{ $category->status ? "Active" : 'Inactive' }}</td>

                <td class="text-center" style="width: 134px;">
                    <div
                        role="group"
                        aria-label="Row Actions"
                        class="btn-group"
                    >
                        @can('update', $category)
                            <a
                                href="{{ route('categories.edit', $category) }}"
                            >
                                <button
                                    type="button"
                                    class="btn btn-light"
                                >
                                    <i class="icon fas fa-edit fa-sm"></i>
                                </button>
                            </a>
                        @endcan @can('view', $category)
                            <a
                                href="{{ route('categories.show', $category) }}"
                            >
                                <button
                                    type="button"
                                    class="btn btn-light"
                                >
                                    <i class="icon fas fa-eye fa-sm"></i>
                                </button>
                            </a>
                        @endcan @can('delete', $category)
                            <form
                                action="{{ route('categories.destroy', $category) }}"
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
            {!! $categories->render() !!}
        </x-slot>
    </x-app.table>
@endsection
