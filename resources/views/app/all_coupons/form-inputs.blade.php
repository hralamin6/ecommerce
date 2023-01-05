@php $editing = isset($coupons) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="code"
            label="Code"
            value="{{ old('code', ($editing ? $coupons->code : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.number
            name="discount"
            label="Discount"
            value="{{ old('discount', ($editing ? $coupons->discount : '')) }}"
            max="255"
            step="0.01"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.select name="discount_type" label="Discount Type">
            @php $selected = old('discount_type', ($editing ? $coupons->discount_type : '')) @endphp
            <option value="percent" {{ $selected == 'percent' ? 'selected' : '' }} >Percent</option>
            <option value="amount" {{ $selected == 'amount' ? 'selected' : '' }} >Amount</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.datetime
            name="start"
            label="Start"
            value="{{ old('start', ($editing ? optional($coupons->start)->format('Y-m-d\TH:i:s') : '')) }}"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.datetime
            name="end"
            label="End"
            value="{{ old('end', ($editing ? optional($coupons->end)->format('Y-m-d\TH:i:s') : '')) }}"
            required
        ></x-inputs.datetime>
    </x-inputs.group>
</div>
