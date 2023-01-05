@extends('layouts.app')
@section('title') {{__('crud.sliders.index_title')}} @endsection
@section('section-title') {{__('crud.sliders.index_title')}} @endsection
@section('section-content')
    <x-app.table>
        <x-slot name="search">{{ $search ?? "" }}</x-slot>
        <x-slot name="create">

            @can('create', App\Models\Slider::class)
                <a
                        href="{{ route('sliders.create') }}"
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
                @lang('crud.sliders.inputs.title')
            </th>
            <th class="text-left">
                @lang('crud.sliders.inputs.subtitle')
            </th>
            <th class="text-left">
                @lang('crud.sliders.inputs.action')
            </th>
            <th class="text-left">
                @lang('crud.sliders.inputs.image')
            </th>
            <th class="text-left">
                @lang('crud.sliders.inputs.status')
            </th>
            <th class="text-center">
                @lang('crud.common.actions')
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($sliders as $slider)
            <tr>
                <td>{{ $slider->title ?? '-' }}</td>
                <td>{{ $slider->subtitle ?? '-' }}</td>
                <td>{{ $slider->action ?? '-' }}</td>
                <td>
                    <x-partials.thumbnail
                            src="{{ $slider->image ? asset($slider->image) : '' }}"
                    />
                </td>
                <td>{{ $slider->status ? "Active" : "Inactive" }}</td>
                <td class="text-center" style="width: 134px;">
                    <div
                            role="group"
                            aria-label="Row Actions"
                            class="btn-group"
                    >
                        @can('update', $slider)
                            <a
                                    href="{{ route('sliders.edit', $slider) }}"
                            >
                                <button
                                        type="button"
                                        class="btn btn-light"
                                >
                                    <i class="icon fas fa-edit fa-sm"></i>
                                </button>
                            </a>
                        @endcan @can('view', $slider)
                            <a
                                    href="{{ route('sliders.show', $slider) }}"
                            >
                                <button
                                        type="button"
                                        class="btn btn-light"
                                >
                                    <i class="icon fas fa-eye fa-sm"></i>
                                </button>
                            </a>
                        @endcan @can('delete', $slider)
                            <form
                                    action="{{ route('sliders.destroy', $slider) }}"
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
            {!! $sliders->render() !!}
        </x-slot>
    </x-app.table>
@endsection