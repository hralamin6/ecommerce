@extends('layouts.app')
@section('title', __('crud.districts_all_sub_districts.index_title'))
@section('section-title', __('crud.districts_all_sub_districts.index_title'))
@section('section-content')
    <div class="row">
        <div class="col-12 col-sm-6">
            <x-form
                method="POST"
                action="{{ route('all-sub-districts.store') }}"
                class="mt-4"
            >
                @include('app.all_sub_districts.form-inputs')

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
                    <th class="text-left">
                        @lang('crud.districts_all_sub_districts.inputs.districts_id')
                    </th>
                    <th class="text-left">
                        @lang('crud.districts_all_sub_districts.inputs.name')
                    </th>
                    <th class="text-left">
                        @lang('crud.districts_all_sub_districts.inputs.status')
                    </th>
                    <th class="text-center">
                        @lang('crud.common.actions')
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($allSubDistricts as $subDistricts)
                    <tr>
                        <td>
                            {{ optional($subDistricts->districts)->name ??
                            '-' }}
                        </td>
                        <td>{{ $subDistricts->name ?? '-' }}</td>
                        <td>{{ $subDistricts->status ? 'Active' : 'Inactive' }}</td>
                        <td class="text-center" style="width: 134px;">
                            <div
                                role="group"
                                aria-label="Row Actions"
                                class="btn-group"
                            >
                                @can('update', $subDistricts)
                                    <a
                                        href="{{ route('all-sub-districts.edit', $subDistricts) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                @endcan  @can('delete', $subDistricts)
                                    <form
                                        action="{{ route('all-sub-districts.destroy', $subDistricts) }}"
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
                    {!! $allSubDistricts->render() !!}
                </x-slot>
            </x-app.table>
        </div>

    </div>
@endsection
