@extends('layouts.app')
@section('title') {{__('crud.roles.index_title')}} @endsection
@section('section-title') {{__('crud.roles.index_title')}} @endsection
@section('section-content')
<x-app.table>
    <x-slot name="search">{{ $search ?? "" }}</x-slot>
    <x-slot name="create">
        <div class="col-md-6 text-right">
            @can('create', App\Models\Role::class)
                        <a
                            href="{{ route('roles.create') }}"
                            class="btn btn-primary"
                        >
                            <i class="icon fas fa-plus"></i>
                            @lang('crud.common.create')
                        </a>
                        @endcan
        </div>
    </x-slot>
    <thead>
        <tr>
            <th class="text-left">
                @lang('crud.roles.inputs.name')
            </th>
            <th class="text-center">
                @lang('crud.common.actions')
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse($roles as $role)
        <tr>
            <td class="text-capitalize">{{ $role->name ?? '-' }}</td>
            <td class="text-center" style="width: 134px;">
                <div
                    role="group"
                    aria-label="Row Actions"
                    class="btn-group"
                >
                    @can('update', $role)
                    <a href="{{ route('roles.edit', $role) }}">
                        <button
                            type="button"
                            class="btn btn-light"
                        >
                            <i class="icon fas fa-edit fa-sm"></i>
                        </button>
                    </a>
                    @endcan @can('delete', $role)
                    <form
                        action="{{ route('roles.destroy', $role) }}"
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
        {!! $roles->render() !!}
    </x-slot>
</x-app.table>

@endsection
