@extends('layouts.app')
@section('title') {{__('crud.all_districts.index_title')}} @endsection
@section('section-title') {{__('crud.all_districts.index_title')}} @endsection
@section('section-content')
    <div class="row">
        <div class="col-12 col-sm-6">
            <x-form
                method="POST"
                action="{{ route('all-districts.store') }}"
                class="mt-4"
            >
                @include('app.all_districts.form-inputs')

                <div class="mt-4">


                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-save"></i>
                        @lang('crud.common.create')
                    </button>
                </div>
            </x-form>
        </div>
        <div class="col-12 col-sm-6">
            <x-app.table>
                <x-slot name="search">{{ $search ?? "" }}</x-slot>
                <thead>
                <tr>
                    <th class="text-left" scope="col">
                        @lang('crud.all_districts.inputs.name')
                    </th>
                    <th class="text-left d-none d-sm-block">
                        @lang('crud.all_districts.inputs.status')
                    </th>
                    <th class="text-center" scope="col">
                        @lang('crud.common.actions')
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($allDistricts as $districts)
                    <tr>
                        <td scope="row">{{ $districts->name ?? '-' }}</td>
                        <td class="d-none d-sm-block">{{ $districts->status ? 'Active' : 'Inactive' }}</td>
                        <td class="text-center ">
                            <div
                                role="group"
                                aria-label="Row Actions"
                                class="btn-group"
                            >
                                @can('update', $districts)
                                    <a
                                        href="{{ route('all-districts.edit', $districts) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                @endcan @can('delete', $districts)
                                    <form
                                        action="{{ route('all-districts.destroy', $districts) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
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
                        <td colspan="3">
                            @lang('crud.common.no_items_found')
                        </td>
                    </tr>
                @endforelse
                </tbody>
                <x-slot name="pagination">
                    {!! $allDistricts->render() !!}
                </x-slot>
            </x-app.table>
        </div>

    </div>


@endsection
