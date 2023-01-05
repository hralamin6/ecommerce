@extends('layouts.app')
@section('title') {{__('crud.wallet.name')}} @endsection
@section('section-title') {{__('crud.wallet.name')}} @endsection
@section('section-content')
    <div class="card">
        <div class="card-body">
            {{$dataTable->table()}}
        </div>
    </div>
@endsection
@push('scripts')
    {{$dataTable->scripts()}}
@endpush