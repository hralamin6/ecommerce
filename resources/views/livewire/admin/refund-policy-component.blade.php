{{--@extends('layouts.app')--}}
@section('title') {{__('crud.refund_policy.create_title')}} @endsection
@section('section-title') {{__('crud.refund_policy.create_title')}} @endsection
    <div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div wire:ignore class="form-group">
                <trix-editor class="formatted-content" x-data x-on:trix-change="$dispatch('input', event.target.value)"
                             wire:model.debounce.1000ms="body" wire:key="uniqueKey"></trix-editor>
                @error('body') <span class="text-danger text-bold"> {{$message}}</span>@enderror
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('home') }}" class="btn btn-light">
                <i class="icon fas fa-arrow-left text-primary"></i>
                @lang('crud.common.back')
            </a>
            <button wire:click="Update" type="button" class="btn btn-primary float-right">
                <i class="icon fas fa-save"></i>
                @lang('crud.common.create')
                <span wire:loading wire:target="Update" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            </button>
        </div>
    </div>
