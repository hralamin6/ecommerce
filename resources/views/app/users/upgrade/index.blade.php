@extends('layouts.app')
@section('title') {{__('crud.users.upgrade_list')}}  @endsection
@section('section-title') {{__('crud.users.upgrade_list')}}@endsection
@section('section-content')
    <x-app.table>
        <x-slot name="search">{{ $search ?? "" }}</x-slot>
        <thead>
        <tr>
            <th class="text-left">
                @lang('crud.users.inputs.avatar')
            </th>
            <th class="text-left">
                @lang('crud.users.inputs.name')
            </th>
            <th class="text-left">
                @lang('crud.users.inputs.username')
            </th>
            <th class="text-left">
                @lang('crud.users.inputs.email')
            </th>
            <th class="text-left">
                @lang('crud.users.inputs.phone')
            </th>
            <th class="text-left">
                @lang('crud.users.inputs.user_type')
            </th>
            <th class="text-left">
                @lang('crud.users.inputs.point')
            </th>
            <th class="text-left">
                @lang('crud.users.inputs.balance')
            </th>
            <th class="text-center">
                @lang('crud.common.actions')
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr>
                <td>
                    <x-partials.thumbnail
                            src="{{ $user->avatar ? asset($user->avatar) : '' }}"
                    />
                </td>
                <td>{{ $user->name ?? '-' }}</td>
                <td>{{ $user->username ?? '-' }}</td>
                <td>{{ $user->email ?? '-' }}</td>
                <td>{{ $user->phone ?? '-' }}</td>
                <td class="text-capitalize">{{ $user->user_type ?? '-' }}</td>
                <td>{{ $user->point ?? '-' }}</td>
                <td>{{ $user->balance ?? '-' }}</td>
                <td class="text-center" style="width: 134px;">
                    <div
                            role="group"
                            aria-label="Row Actions"
                            class="btn-group"
                    >
                        @can('view', $user)
                            <a href="{{ route('upgrade.show', $user) }}">
                                <button
                                        type="button"
                                        class="btn btn-light"
                                >
                                    <i class="icon fas fa-eye fa-sm"></i>
                                </button>
                            </a>
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
            {!! $users->render() !!}
        </x-slot>
    </x-app.table>
@endsection
