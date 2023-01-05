@extends('layouts.app')
@section('title') {{__('crud.all_products.index_title')}} @endsection
@section('section-title') {{__('crud.all_products.index_title')}} @endsection
@section('section-content')
    <x-app.table>
        <x-slot name="search">{{ $search ?? "" }}</x-slot>
        <x-slot name="create">
            @can('create', App\Models\Products::class)
                <a
                        href="{{ route('all-products.create') }}"
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
                Code
            </th>
            <th class="text-left">
                @lang('crud.all_products.inputs.category_id')
            </th>
            <th class="text-left">
                @lang('crud.all_products.inputs.name')
            </th>
            <th class="text-left">
                @lang('crud.all_products.inputs.sale_price')
            </th>
            <th class="text-left">
                @lang('crud.all_products.inputs.purchase_price')
            </th>
            <th class="text-left">
                @lang('crud.all_products.inputs.thumbnail_img')
            </th>
            <th class="text-left">
                @lang('crud.all_products.inputs.status')
            </th>
            <th class="text-left">
                @lang('crud.all_products.inputs.is_flash')
            </th>
            <th class="text-left">
                @lang('crud.all_products.inputs.is_feature')
            </th>
            <th class="text-left">
                @lang('crud.all_products.inputs.discount')
            </th>
            <th class="text-left">
                @lang('crud.all_products.inputs.stock')
            </th>
            <th class="text-center">
                @lang('crud.common.actions')
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($allProducts as $products)
            <tr>
                <td>{{ $products->id }}</td>
                <td>
                    {{ optional($products->category)->name ?? '-' }}
                </td>
                <td>{{ $products->name ?? '-' }}</td>
                <td>{{ $products->sale_price ?? '-' }}</td>
                <td>{{ $products->purchase_price ?? '-' }}</td>

                <td>
                    <x-partials.thumbnail
                            src="{{ $products->thumbnail_img ? asset($products->thumbnail_img) : '' }}"
                    />
                </td>
                <td>{{ $products->status ? "Active" : "Inactive" }}</td>
                <td>{{ $products->is_flash ? 'Yes' : 'No' }}</td>
                <td>{{ $products->is_feature ? 'Yes' : 'No' }}</td>
                <td> {{$products->discount }} @if($products->discount != null){{($products->discount_type == 'percentage') ? ' %' : ' Taka' }} @endif</td>

                <td>{{ $products->stock ?? '-' }}</td>
                <td class="text-center" style="width: 134px;">
                    <div
                            role="group"
                            aria-label="Row Actions"
                            class="btn-group"
                    >
                        @can('update', $products)
                            <a
                                    href="{{ route('all-products.edit', $products) }}"
                            >
                                <button
                                        type="button"
                                        class="btn btn-light"
                                >
                                    <i class="icon fas fa-edit fa-sm"></i>
                                </button>
                            </a>
                        @endcan @can('view', $products)
                            <a
                                    href="{{route('shop.product', ['product'=>$products->slug])}}"
                            >
                                <button
                                        type="button"
                                        class="btn btn-light"
                                >
                                    <i class="icon fas fa-eye fa-sm"></i>
                                </button>
                            </a>
                        @endcan @can('delete', $products)
                            <form
                                    action="{{ route('all-products.destroy', $products) }}"
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
                <td colspan="14">
                    @lang('crud.common.no_items_found')
                </td>
            </tr>
        @endforelse
        </tbody>
        <x-slot name="pagination">
            {!! $allProducts->render() !!}
        </x-slot>
    </x-app.table>

@endsection
