@extends('layouts.app')
@section('title') {{__('crud.permissions.index_title')}} @endsection
@section('section-title') {{__('crud.permissions.index_title')}} @endsection
@section('section-content')
    <x-app.table>
        <x-slot name="search">{{ $search ?? "" }}</x-slot>
        <x-slot name="create">
            @can('create', App\Models\Permission::class)
                <a
                        href="{{ route('permissions.create') }}"
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
                @lang('crud.permissions.inputs.name')
            </th>
            <th class="text-center">
                @lang('crud.common.actions')
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($permissions as $permission)
            <tr>
                <td>{{ $permission->name ?? '-' }}</td>
                <td class="text-center" style="width: 134px;">
                    <div
                            role="group"
                            aria-label="Row Actions"
                            class="btn-group"
                    >
                        @can('update', $permission)
                            <a
                                    href="{{ route('permissions.edit', $permission) }}"
                            >
                                <button
                                        type="button"
                                        class="btn btn-light"
                                >
                                    <i class="icon fas fa-edit fa-sm"></i>
                                </button>
                            </a>
                        @endcan @can('delete', $permission)
                            <form
                                    action="{{ route('permissions.destroy', $permission) }}"
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
                <td colspan="2">
                    @lang('crud.common.no_items_found')
                </td>
            </tr>
        @endforelse
        </tbody>
        <x-slot name="pagination">
            {!! $permissions->render() !!}
        </x-slot>
    </x-app.table>

@endsection
