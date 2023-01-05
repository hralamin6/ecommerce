@php $editing = isset($slider) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
                name="title"
                label="Title"
                value="{{ old('title', ($editing ? $slider->title : '')) }}"
                maxlength="100"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
                name="subtitle"
                label="Subtitle"
                value="{{ old('subtitle', ($editing ? $slider->subtitle : '')) }}"
                maxlength="100"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.basic
                type="url"
                name="action"
                label="Action"
                value="{{ old('action', ($editing ? $slider->action : '')) }}"
                maxlength="255"
        ></x-inputs.basic>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-8">
        <div
                x-data="imageViewer('{{ $editing && $slider->image ? asset($slider->image) : '' }}')"
        >
            <x-inputs.partials.label
                    name="image"
                    label="Image (1920x600)"
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
                        name="image"
                        id="image"
                        @change="fileChosen"
                />
            </div>

            @error('image') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.checkbox
                name="status"
                label="Active ?"
                :checked="old('status', ($editing ? $slider->status : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
