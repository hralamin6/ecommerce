@php $editing = isset($products) @endphp

<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card">
            <div class="card-header">
                Product Information
            </div>
            <div class="card-body">

                <div class="row">
                    <x-inputs.group class="col-12">
                        <x-inputs.text
                            name="name"
                            label="Name"
                            value="{{ old('name', ($editing ? $products->name : '')) }}"
                            maxlength="255"
                            required
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-12">
                        <x-inputs.select name="category_id" label="Category" required>
                            @php $selected = old('category_id', ($editing ? $products->category_id : '')) @endphp
                            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Category
                            </option>
                            @foreach($categories as $value => $label)
                                <option
                                    value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>
                    <x-inputs.group class="col-12 col-sm-6 col-md-4 col-lg-4">
                        <x-inputs.checkbox
                            name="status"
                            label="Active ?"
                            :checked="old('status', ($editing ? $products->status  : 0))"
                        ></x-inputs.checkbox>
                    </x-inputs.group>
                </div>


            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Product Inventory
            </div>
            <div class="card-body">
                <div class="row">
                    <x-inputs.group class="col-4">
                        <x-inputs.number
                            name="point"
                            label="Reward point"
                            value="{{ old('point', ($editing ? $products->point : '0')) }}"
                            step="0.01"
                            required
                        ></x-inputs.number>
                    </x-inputs.group>
                    <x-inputs.group class="col-4">
                        <x-inputs.number
                            name="sale_price"
                            label="Sale Price"
                            value="{{ old('sale_price', ($editing ? $products->sale_price : '0')) }}"
                            step="0.01"
                            required
                        ></x-inputs.number>
                    </x-inputs.group>
                    <x-inputs.group class="col-4">
                        <x-inputs.number
                            name="purchase_price"
                            label="Purchase Price"
                            value="{{ old('purchase_price', ($editing ? $products->purchase_price : '0')) }}"
                            step="0.01"
                            required
                        ></x-inputs.number>
                    </x-inputs.group>
                    <x-inputs.group class="col-12 col-sm-6 col-md-4 col-lg-4">
                        <x-inputs.number
                            name="discount"
                            label="Discount"
                            value="{{ old('discount', ($editing ? $products->discount : '')) }}"
                            step="0.01"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-12 col-sm-6 col-md-4 col-lg-4">
                        <x-inputs.select name="discount_type" label="Discount Type">
                            @php $selected = old('discount_type', ($editing ? $products->discount_type : '')) @endphp
                            <option value="percentage" {{ $selected == 'percentage' ? 'selected' : '' }} >Percentage
                            </option>
                            <option value="amount" {{ $selected == 'amount' ? 'selected' : '' }} >Amount</option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-12 col-sm-6 col-md-4 col-lg-4">
                        <x-inputs.number
                            name="stock"
                            label="Stock"
                            value="{{ old('stock', ($editing ? $products->stock : '0')) }}"
                            max="255"
                            required
                        ></x-inputs.number>
                    </x-inputs.group>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Product Variation
            </div>
            <div class="card-body">
                <div class="row">
                    <x-inputs.group class="col-12">
                        <label class="label">Select Product colors</label>
                        <select class="form-control" data-live-search="true" data-selected-text-format="count" data-actions-box="true"
                                name="colors[]" id="colors" multiple>
                            @foreach($colors as $color)
                                <option value="{{ $color->name }}"
                                        @if($editing && $products->is_variant && in_array ($color->name, json_decode ($products->colors))) selected
                                        @endif
                                        data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:{{ $color->code }}; width:10px; height:10px'></span><span>{{ $color->name }}</span></span>">
                                </option>
                            @endforeach
                        </select>
                    </x-inputs.group>
                    <x-inputs.group class="col-12">
                        <x-inputs.text
                            name="sizes"
                            label="Product Sizes ( Press Enter after inserting every size )"
                            value="{{ old('sizes', ($editing ? $products->sizes : '')) }}"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <div class="col-12 table-responsive" id="product-variation-holder">
                        @if($editing && $products->is_variant)
                            <input type="hidden" name="is_variant" value="1">
                            <table class="table table-borderless table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($products->variations as $variation)
                                    <tr>
                                        <th scope="row">{{ $variation->sku }}</th>
                                        <td><input type="number" value="{{ $variation->quantity }}"
                                                   name="{{$variation->sku}}_quantity" class="form-control"></td>
                                        <td><input type="number" value="{{ $variation->price }}"
                                                   name="{{$variation->sku}}_price" class="form-control"></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
            `
        </div>

    </div>
    <div class="col-12 col-sm-6">
        <div class="card">
            <div class="card-header">
                Product Images
            </div>
            <div class="card-header">
                <div class="row">
                    <x-inputs.group class="col-12">
                        <div>
                            <x-inputs.partials.label
                                name="gallery"
                                label="gallery ( 1920x600 or 300x300 )"
                            ></x-inputs.partials.label
                            >
                            <br/>
                            @if(isset($products->gallery)) @foreach(json_decode($products->gallery) as $image)  <img
                                src="{{ asset($image) }}"
                                class="object-cover rounded border border-gray-200"
                                style="width: 100px; height: 100px;"
                            /> @endforeach @endif
                            <div class="mt-2">
                                <input
                                    type="file"
                                    name="gallery[]"
                                    id="gallery"
                                    multiple
                                />
                            </div>

                            @error('gallery') @include('components.inputs.partials.error')
                            @enderror
                        </div>
                    </x-inputs.group>

                    <x-inputs.group class="col-12">
                        <div
                            x-data="imageViewer('{{ $editing && $products->thumbnail_img ? asset($products->thumbnail_img) : '' }}')"
                        >
                            <x-inputs.partials.label
                                name="thumbnail_img"
                                label="Thumbnail Image ( 300x300 )"
                            ></x-inputs.partials.label
                            >
                            <br/>

                            <!-- Show the image -->
                            <template x-if="imageUrl">
                                <img
                                    :src="imageUrl"
                                    class="object-cover rounded border border-gray-200"
                                    style="width: 100px; height: 100px;"
                                />
                            </template>

                            <!-- Show the gray box when image is not available -->
                            <template x-if="!imageUrl">
                                <div
                                    class="border rounded border-gray-200 bg-gray-100"
                                    style="width: 100px; height: 100px;"
                                ></div>
                            </template>

                            <div class="mt-2">
                                <input
                                    type="file"
                                    name="thumbnail_img"
                                    id="thumbnail_img"
                                    @change="fileChosen"
                                />
                            </div>

                            @error('thumbnail_img') @include('components.inputs.partials.error')
                            @enderror
                        </div>
                    </x-inputs.group>
                </div>


            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Product Promotion
            </div>
            <div class="card-body">
                <div class="row">
                    <x-inputs.group class="col-12 col-sm-6 col-md-4 col-lg-4">
                        <x-inputs.checkbox
                            name="is_flash"
                            label="Is Flash"
                            :checked="old('is_flash', ($editing ? $products->is_flash : 0))"
                        ></x-inputs.checkbox>
                    </x-inputs.group>
                    <x-inputs.group class="col-12 col-sm-6 col-md-4 col-lg-4">
                        <x-inputs.checkbox
                            name="is_feature"
                            label="Is Feature"
                            :checked="old('is_feature', ($editing ? $products->is_feature : 0))"
                        ></x-inputs.checkbox>
                    </x-inputs.group>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Product Description
            </div>
            <div class="card-body">
                <x-inputs.group class="col-12">
                    <x-inputs.textarea
                        name="description"
                        label="Description"
                        maxlength="255"
                        class="techitor"
                    >{{ old('description', ($editing ? $products->description : ''))
            }}</x-inputs.textarea
                    >

                </x-inputs.group>
            </div>
        </div>
    </div>


</div>


