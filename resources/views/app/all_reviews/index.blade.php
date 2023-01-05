@extends('layouts.app')
@section('title') {{__('crud.all_reviews.index_title')}} @endsection
@section('section-title') {{__('crud.all_reviews.index_title')}} @endsection
@section('section-content')
    <x-app.table>
        <x-slot name="search">{{ $search ?? "" }}</x-slot>
        <x-slot name="create">
            @can('create', App\Models\Reviews::class)
                <a
                        href="{{ route('all-reviews.create') }}"
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
                @lang('crud.all_reviews.inputs.user_id')
            </th>
            <th class="text-left">
                @lang('crud.all_reviews.inputs.products_id')
            </th>
            <th class="text-left">
                @lang('crud.all_reviews.inputs.rating')
            </th>
            <th class="text-left">
                @lang('crud.all_reviews.inputs.status')
            </th>
            <th class="text-left">
                @lang('crud.all_reviews.inputs.viewed')
            </th>
            <th class="text-center">
                @lang('crud.common.actions')
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($allReviews as $reviews)
            <tr>
                <td>{{ optional($reviews->user)->name ?? '-' }}</td>
                <td>
                    {{ optional($reviews->products)->name ?? '-' }}
                </td>
                <td>{{ $reviews->rating ?? '-' }}</td>
                <td>{{ $reviews->status ? "Active" : "Inactive" }}</td>
                <td>{{ $reviews->viewed ? "Yes" : "No" }}</td>
                <td class="text-center" style="width: 134px;">
                    <div
                            role="group"
                            aria-label="Row Actions"
                            class="btn-group"
                    >
                        @can('update', $reviews)
                            <a
                                    href="{{ route('all-reviews.edit', $reviews) }}"
                            >
                                <button
                                        type="button"
                                        class="btn btn-light"
                                >
                                    <i class="icon fas fa-edit fa-sm"></i>
                                </button>
                            </a>
                        @endcan @can('view', $reviews)
                            <a
                                    href="{{ route('all-reviews.show', $reviews) }}"
                            >
                                <button
                                        type="button"
                                        class="btn btn-light"
                                >
                                    <i class="icon fas fa-eye fa-sm"></i>
                                </button>
                            </a>
                        @endcan @can('delete', $reviews)
                            <form
                                    action="{{ route('all-reviews.destroy', $reviews) }}"
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
            {!! $allReviews->render() !!}
        </x-slot>
    </x-app.table>
        
@endsection
