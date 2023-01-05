@php $editing = isset($reviews) @endphp

<div class="row">
    <x-inputs.group class="col-sm-6 col-md-4 col-lg-3">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $reviews->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-6 col-md-4 col-lg-3">
        <x-inputs.select name="products_id" label="Products" required>
            @php $selected = old('products_id', ($editing ? $reviews->products_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Products</option>
            @foreach($allProducts as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-6 col-md-4 col-lg-3">
        <x-inputs.number
            name="rating"
            label="Rating"
            value="{{ old('rating', ($editing ? $reviews->rating : '0')) }}"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-12">
        <x-inputs.textarea name="comment" label="Comment" maxlength="255"
            >{{ old('comment', ($editing ? $reviews->comment : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-6 col-md-4 col-lg-3">
        <x-inputs.checkbox
            name="status"
            label="Active ?"
            :checked="old('status', ($editing ? $reviews->status : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
    
</div>
