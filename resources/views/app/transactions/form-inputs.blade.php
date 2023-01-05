@php $editing = isset($transection) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $transection->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="work_id" label="Work">
            @php $selected = old('work_id', ($editing ? $transection->work_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Work</option>
            @foreach($works as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="amount"
            label="Amount"
            value="{{ old('amount', ($editing ? $transection->amount : '0')) }}"
            max="255"
            step="0.01"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="note" label="Note" maxlength="255"
            >{{ old('note', ($editing ? $transection->note : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
