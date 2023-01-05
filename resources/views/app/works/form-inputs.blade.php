@php $editing = isset($work) @endphp

    <p>For youtube: <button id="add-youtube-prefix" class="btn btn-info btn-sm">Click here</button></p>
<div class="row">
    <x-inputs.group class="col-12 col-sm-8">
        <x-inputs.basic
                name="url"
                type="url"
                label="Url"
                value="{{ old('url', ($editing ? $work->url : '')) }}"
                maxlength="255"
        ></x-inputs.basic>
    </x-inputs.group>

    <x-inputs.group class="col-12 col-sm-4">
        <x-inputs.select name="type" label="File Type">
            <option value="" selected >Select one</option>
            @php $selected = old('type', ($editing ? $work->type : '')) @endphp
            <option value="image" {{ $selected == 'image' ? 'selected' : '' }} >Image</option>
            <option value="video" {{ $selected == 'video' ? 'selected' : '' }} >Video</option>
        </x-inputs.select>
    </x-inputs.group>
    <x-inputs.group class="col-12 col-sm-4">
        <x-inputs.basic
            name="file"
            type="file"
            label="File"
            value="{{ old('file', ($editing ? $work->file : '')) }}"

        ></x-inputs.basic>
    </x-inputs.group>
    <x-inputs.group class="col-12 col-sm-4">
        <x-inputs.number
            name="duration"
            label="Duration"
            value="{{ old('duration', ($editing ? $work->duration : '0')) }}"
            step="0.01"
            :required="$editing"
        ></x-inputs.number>
    </x-inputs.group>
    <x-inputs.group class="col-12 col-sm-4">
        <x-inputs.number
            name="price"
            label="Price"
            value="{{ old('price', ($editing ? $work->price : '0')) }}"
            step="0.01"
            :required="$editing"
        ></x-inputs.number>
    </x-inputs.group>
    <x-inputs.group class="col-12">
        <x-inputs.textarea name="notes" label="Notes" maxlength="255">
            {{ old('notes', ($editing ? $work->notes : '')) }}
        </x-inputs.textarea>
    </x-inputs.group>

    <x-inputs.group class="col-12 col-sm-6">
        <x-inputs.checkbox
                name="status"
                label="Status"
                :checked="old('status', ($editing ? $work->status : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
