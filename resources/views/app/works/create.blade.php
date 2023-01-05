@extends('layouts.app')
@section('title') {{__('crud.works.create_title')}} @endsection
@section('section-title') {{__('crud.works.create_title')}} @endsection
@section('section-content')


    <x-form
            method="POST"
            action="{{ route('works.store') }}"
            class="mt-4"
            has-files
    >
        @include('app.works.form-inputs')

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
