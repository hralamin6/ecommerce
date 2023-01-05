@php $editing = isset($subDistricts) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="districts_id" label="Districts" required>
            @php $selected = old('districts_id', ($editing ? $subDistricts->districts_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Districts</option>
            @foreach($allDistricts as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $subDistricts->name : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.checkbox
            name="status"
            label="Status"
            :checked="old('status', ($editing ? $subDistricts->status : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
