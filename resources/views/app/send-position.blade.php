@extends('layouts.app')
@section('title') {{__('crud.wallet.position')}} @endsection
@section('section-title') {{__('crud.wallet.position')}} @endsection
@section('section-content')
    <x-form
        method="POST"
        action="{{ route('save.position') }}"
        class="mt-4"
    >
        <div class="row">
            <input type="hidden" name="users" value="{{ request ()->query ('users') }}">
            <x-inputs.group class="col-sm-12">
                <x-inputs.number
                    name="amount"
                    label="Amount"
                    value="{{ old('amount', '0') }}"
                    step="0.01"
                    required
                ></x-inputs.number>
            </x-inputs.group>

            <x-inputs.group class="col-sm-12">
                <x-inputs.textarea name="note" label="Note" maxlength="255">
                    {{ old('note', '') }}
                </x-inputs.textarea>
            </x-inputs.group>
        </div>

        <div class="mt-4">
            <a href="{{ route('works.index') }}" class="btn btn-light">
                <i class="icon ion-md-return-left text-primary"></i>
                @lang('crud.common.back')
            </a>

            <button type="submit" class="btn btn-primary float-right">
                <i class="icon ion-md-save"></i>
                @lang('crud.common.create')
            </button>
        </div>
    </x-form>
@endsection
@push('stylesheet')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#user_id').select2();
            $('.select2').select2();
        });
    </script>
@endpush
