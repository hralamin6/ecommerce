@extends('layouts.app')
@section('title') {{__('crud.works.index_title')}} @endsection
@section('section-title') {{__('crud.works.index_title')}} @endsection
@section('section-content')
    <x-app.table>
        <x-slot name="search">{{ $search ?? "" }}</x-slot>
        <x-slot name="create">

            @can('create', App\Models\User::class)
                <a
                    href="{{ route('works.create') }}"
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
                @lang('crud.works.inputs.url')
            </th>
            <th class="text-left">
                @lang('crud.works.inputs.file')
            </th>
            <th class="text-left">
                @lang('crud.works.inputs.duration')
            </th>
            <th class="text-left" style="min-width: 4vw;">
                @lang('crud.works.inputs.price')
            </th>
            <th class="text-left">
                @lang('crud.works.inputs.notes')
            </th>
            <th class="text-left">
                @lang('crud.works.inputs.status')
            </th>
            <th class="text-center">
                @lang('crud.common.actions')
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($works as $work)
            <tr>
                <td>{{ $work->url ?? '-' }}</td>
                <td>
                    @if($work->type == 'image')
                        <x-partials.thumbnail
                            src="{{ asset($work->file) }}"
                        />
                    @endif
                    @if($work->type == 'video')
                        <video width="200" controls>
                            <source src="{{ asset($work->file) }}">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                </td>
                <td>{{ $work->duration ?? '-' }}</td>
                <td>@taka($work->price)</td>
                <td>{{ $work->notes ?? '-' }}</td>
                <td>{{ $work->status ? 'Yes' : 'No' }}</td>
                <td class="text-center" style="width: 134px;">
                    <div
                        role="group"
                        aria-label="Row Actions"
                        class="btn-group"
                    >
                        @can('update', $work)
                            <a href="{{ route('works.edit', $work) }}">
                                <button
                                    type="button"
                                    class="btn btn-light btn-sm"
                                >
                                    <i class="fas fa-edit"></i>
                                </button>
                            </a>
                        @endcan  @can('delete', $work)
                            <form
                                action="{{ route('works.destroy', $work) }}"
                                method="POST"
                                onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                            >
                                @csrf @method('DELETE')
                                <button
                                    type="submit"
                                    class="btn btn-light btn-sm text-danger"
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
                <td colspan="10">
                    @lang('crud.common.no_items_found')
                </td>
            </tr>
        @endforelse
        </tbody>
        <x-slot name="pagination">
            {!! $works->render() !!}
        </x-slot>
    </x-app.table>
@endsection
