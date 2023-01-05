@extends('layouts.app')
@section('section-title', __('crud.common.settings'))
@section('title-action')
    <a href="{{ route('server.down') }}"
       onclick="if (confirm('Do you really want to down server?? You can not revert this action after start!')) alert('Please wait for a while'); window.location.replace('{{ route("server.down") }}')"
       class="ml-auto btn btn-danger">Server Down</a>
@endsection
@section('section-content')
    @php $settings = \Illuminate\Support\Facades\DB::table('settings')->get()->collect() @endphp
    <x-form
        method="POST"
        action="{{ route('settings') }}"
        class="mt-4"
    >
        <div class="row">
            <x-inputs.group class="col-12 col-sm-6">
                <x-inputs.datetime
                    name="flash_start"
                    label="Flash sale start date"
                    value="{{ old('flash_start', ($settings ? optional(\Carbon\Carbon::parse($settings->where('key','flash_start')->first()->value))->format('Y-m-d\TH:i:s') : '')) }}"
                    required
                ></x-inputs.datetime>
            </x-inputs.group>

            <x-inputs.group class="col-12 col-sm-6">
                <x-inputs.datetime
                    name="flash_end"
                    label="Flash sale end date"
                    value="{{ old('flash_end', ($settings ? optional(\Carbon\Carbon::parse($settings->where('key','flash_end')->first()->value))->format('Y-m-d\TH:i:s') : '')) }}"
                    required
                ></x-inputs.datetime>
            </x-inputs.group>

            <x-inputs.group class="col-12 col-sm-6">
                <x-inputs.number
                    name="inside_dhaka"
                    label="Delivery Charge for inside dhaka"
                    value="{{ old('inside_dhaka', ($settings ? optional($settings->where('key', 'inside_dhaka')->first())->value : '60')) }}"
                    max="255"
                    required
                ></x-inputs.number>
            </x-inputs.group>
            <x-inputs.group class="col-12 col-sm-6">
                <x-inputs.number
                    name="outside_dhaka"
                    label="Delivery Charge for outside dhaka"
                    value="{{ old('outside_dhaka', ($settings ? optional($settings->where('key', 'outside_dhaka')->first())->value : '100')) }}"
                    max="255"
                    required
                ></x-inputs.number>
            </x-inputs.group>
            <x-inputs.group class="col-12 col-sm-6">
                <x-inputs.number
                    name="delivery_time_inside_dhaka"
                    label="Delivery time for inside dhaka"
                    value="{{ old('delivery_time_inside_dhaka', ($settings ? optional($settings->where('key', 'delivery_time_inside_dhaka')->first())->value : '60')) }}"
                    max="255"
                    required
                ></x-inputs.number>
            </x-inputs.group>
            <x-inputs.group class="col-12 col-sm-6">
                <x-inputs.number
                    name="delivery_time_outside_dhaka"
                    label="Delivery time for outside dhaka"
                    value="{{ old('delivery_time_outside_dhaka', ($settings ? optional($settings->where('key', 'delivery_time_outside_dhaka')->first())->value : '100')) }}"
                    max="255"
                    required
                ></x-inputs.number>
            </x-inputs.group>

            <x-inputs.group class="col-sm-12 col-lg-12">
                <x-inputs.textarea name="notice"
                                   label="Notice for users">{{ optional($settings->where('key', 'notice')->first())->value ?? null  }}</x-inputs.textarea>
            </x-inputs.group>
        </div>

        <div class="mt-4">
            <a
                href="{{ route('settings.page') }}"
                class="btn btn-light"
            >
                <i class="icon fas fa-arrow-left text-primary"></i>
                @lang('crud.common.back')
            </a>

            <button type="submit" class="btn btn-primary float-right">
                <i class="icon fas fa-save"></i>
                @lang('crud.common.update')
            </button>
        </div>
    </x-form>
@endsection

