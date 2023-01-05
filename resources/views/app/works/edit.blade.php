@extends('layouts.app')
@section('title') {{__('crud.works.edit_title')}} @endsection
@section('section-title') {{__('crud.works.edit_title')}} @endsection
@section('section-content')
    <x-form
            method="PUT"
            action="{{ route('works.update', $work) }}"
            class="mt-4"
    >
        @include('app.works.form-inputs')

        <div class="mt-4">
            <a href="{{ route('works.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left text-primary"></i>
                @lang('crud.common.back')
            </a>

            <a href="{{ route('works.create') }}" class="btn btn-light">
                <i class="fas fa-plus text-primary"></i>
                @lang('crud.common.create')
            </a>

            <button type="submit" class="btn btn-primary float-right">
                <i class="fas fa-save"></i>
                @lang('crud.common.update')
            </button>
        </div>
    </x-form>
@endsection
@push('scripts')
    <script>
        $(document).ready(() => {
            $("#add-youtube-prefix").click((e)=>{
                e.preventDefault();
                $("#url").val("https://www.youtube.com/embed/{video-id}");
            })
        });
    </script>
@endpush
