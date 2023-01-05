@extends('layouts.app')
@section('title') {{__('crud.all_products.create_title')}} @endsection
@section('section-title') {{__('crud.all_products.create_title')}} @endsection
@push('stylesheet')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
          integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endpush
@section('section-content')


    <form
        method="POST"
        action="{{ route('all-products.store') }}"
        enctype="multipart/form-data"
        class="mt-4"
    >
        @csrf

        @include('app.all_products.form-inputs')

        <div class="mt-4">
            <a
                href="{{ route('all-products.index') }}"
                class="btn btn-light"
            >
                <i class="icon fas fa-arrow-left text-primary"></i>
                @lang('crud.common.back')
            </a>

            <button type="submit" class="btn btn-primary float-right">
                <i class="icon fas fa-save"></i>
                @lang('crud.common.create')
            </button>
        </div>
    </form>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"
            integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {
            $("#description").summernote({
                dialogsInBody: true,
                minHeight: 50,
            });
            $('#description').on('summernote.change', function(we, contents, $editable) {
                $('#description').val(contents);
            });
            $('#colors').selectpicker();
            $("#colors").change(() => {
                update_sku();
            });
            $("#sizes").tagsinput()
            $("#sizes").change(()=>{
                update_sku();
            })


        })

    </script>
@endpush
