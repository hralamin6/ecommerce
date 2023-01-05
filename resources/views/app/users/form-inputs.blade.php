@php $editing = isset($user) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <div
            x-data="imageViewer('{{ $editing && $user->avatar ? asset($user->avatar) : '' }}')"
        >
            <x-inputs.partials.label
                name="avatar"
                label="Avatar ( 200x200 )"
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
                    name="avatar"
                    id="avatar"
                    @change="fileChosen"
                />
            </div>

            @error('avatar') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $user->name : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="username"
            label="Username"
            value="{{ old('username', ($editing ? $user->username : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $user->email : '')) }}"
            maxlength="255"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="phone"
            label="Phone"
            value="{{ old('phone', ($editing ? $user->phone : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.password
            name="password"
            label="Password"
            maxlength="255"
            :required="!$editing"
        ></x-inputs.password>
    </x-inputs.group>
    @if($editing && !$user->isAdmin())
        <x-inputs.group class="col-sm-12 col-lg-6">
            <x-inputs.select name="user_type" label="User Type">
                @php $selected = old('user_type', ($editing ? $user->user_type : 'regular')) @endphp
                <option value="regular" {{ $selected == 'regular' ? 'selected' : '' }} >Regular</option>
                <option value="premium" {{ $selected == 'premium' ? 'selected' : '' }} >Premium</option>
            </x-inputs.select>
        </x-inputs.group>
    @endif
    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="shipping" label="Shipping Address"
        >{{ old('shipping', ($editing ? $user->shipping : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
    <x-inputs.group class="col-12 col-sm-6 col-md-4 col-lg-4">
        <x-inputs.checkbox
            name="is_blocked"
            label="Block"
            :checked="old('is_blocked', ($editing ? $user->is_blocked  : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
    {{--    <div class="form-group col-sm-12 mt-4">--}}
    {{--        <h4>Assign @lang('crud.roles.name')</h4>--}}

    {{--        @foreach ($roles as $role)--}}
    {{--        <div>--}}
    {{--            <x-inputs.checkbox--}}
    {{--                id="role{{ $role->id }}"--}}
    {{--                name="roles[]"--}}
    {{--                label="{{ ucfirst($role->name) }}"--}}
    {{--                value="{{ $role->id }}"--}}
    {{--                :checked="isset($user) ? $user->hasRole($role) : false"--}}
    {{--                :add-hidden-value="false"--}}
    {{--            ></x-inputs.checkbox>--}}
    {{--        </div>--}}
    {{--        @endforeach--}}
    {{--    </div>--}}
</div>
