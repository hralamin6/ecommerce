@extends('layouts.app')
@section('title') {{__('crud.all_banners.index_title')}} @endsection
@section('section-title') {{__('crud.all_banners.index_title')}} @endsection
@section('section-content')
<x-app.table>
    <x-slot name="search">{{ $search ?? "" }}</x-slot>
    <x-slot name="create">

            @can('create', App\Models\Banners::class)
                <a
                        href="{{ route('all-banners.create') }}"
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
            @lang('crud.all_banners.inputs.title')
        </th>
        <th class="text-left">
            @lang('crud.all_banners.inputs.sub_title')
        </th>
        <th class="text-left">
            @lang('crud.all_banners.inputs.url')
        </th>
        <th class="text-right">
            @lang('crud.all_banners.inputs.position')
        </th>
        <th class="text-left">
            @lang('crud.all_banners.inputs.photo')
        </th>
        <th class="text-left">
            @lang('crud.all_banners.inputs.status')
        </th>
        <th class="text-center">
            @lang('crud.common.actions')
        </th>
    </tr>
    </thead>
    <tbody>
    @forelse($allBanners as $banners)
        <tr>
            <td>{{ $banners->title ?? '-' }}</td>
            <td>{{ $banners->sub_title ?? '-' }}</td>
            <td>{{ $banners->url ?? '-' }}</td>
            <td>{{ $banners->position ?? '-' }}</td>
            <td>
                <x-partials.thumbnail
                        src="{{ $banners->photo ? asset($banners->photo) : '' }}"
                />
            </td>
            <td>{{ $banners->status ? "Active" : "Inactive" }}</td>
            <td class="text-center" style="width: 134px;">
                <div
                        role="group"
                        aria-label="Row Actions"
                        class="btn-group"
                >
                    @can('update', $banners)
                        <a
                                href="{{ route('all-banners.edit', $banners) }}"
                        >
                            <button
                                    type="button"
                                    class="btn btn-light"
                            >
                                <i class="icon fas fa-edit fa-sm"></i>
                            </button>
                        </a>
                    @endcan @can('view', $banners)
                        <a
                                href="{{ route('all-banners.show', $banners) }}"
                        >
                            <button
                                    type="button"
                                    class="btn btn-light"
                            >
                                <i class="icon fas fa-eye fa-sm"></i>
                            </button>
                        </a>
                    @endcan @can('delete', $banners)
                        <form
                                action="{{ route('all-banners.destroy', $banners) }}"
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
            <td colspan="7">
                @lang('crud.common.no_items_found')
            </td>
        </tr>
    @endforelse
    </tbody>
    <x-slot name="pagination">
        {!! $allBanners->render() !!}
    </x-slot>
</x-app.table>
@endsection
