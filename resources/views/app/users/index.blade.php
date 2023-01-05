@extends('layouts.app')
@section('title') {{__('crud.users.index_title')}}  @endsection
@section('section-title') {{__('crud.users.index_title')}}@endsection
@section('title-action')
    <a href="{{ route('send.incentive') }}" class="btn btn-danger ml-auto">Send Bonus</a>
    <a class="btn btn-danger ml-2" id="position-bonus-button" style="display: none">Send Position Bonus</a>
    <a href="{{ route('upgrade.list') }}" class="btn btn-warning ml-2">Pending Upgrades</a>
@endsection
@section('section-content')
    <div class="card">
        <div class="card-body table-responsive">
            {{$dataTable->table()}}
        </div>
    </div>


@endsection
@push('scripts')
    {{$dataTable->scripts()}}
    <script>
        $(document).ready(function () {
            let users;
            $(document).on('change', '.user-selection', function () {
                users = Array
                    .from(document.querySelectorAll('input[type="checkbox"]'))
                    .filter((checkbox) => checkbox.checked)
                    .map((checkbox) => checkbox.value);
                let $position = $("#position-bonus-button");
                users.length ? $position.show() : $position.hide();
                $position.click(()=>{
                    let url = "{{ route ('send.position') }}" + "?users=" + users;
                    location.href = url;
                })
            });

        });
    </script>
@endpush
