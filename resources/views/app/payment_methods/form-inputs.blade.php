@php $editing = isset($paymentMethod) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.basic
            type="tel"
            name="number"
            label="Number"
            value="{{ old('number', ($editing ? $paymentMethod->number : '')) }}"
            maxlength="255"
            required
        ></x-inputs.basic>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="type" label="Type">
            @php $selected = old('type', ($editing ? $paymentMethod->type : '')) @endphp
            <option value="BKash" {{ $selected == 'BKash' ? 'selected' : '' }} >Bkash</option>
            <option value="Nagad" {{ $selected == 'Nagad' ? 'selected' : '' }} >Nagad</option>
            <option value="Rocket" {{ $selected == 'Rocket' ? 'selected' : '' }} >Rocket</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.checkbox
            name="status"
            label="Show in website ?"
            :checked="old('status', ($editing ? $paymentMethod->status : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
