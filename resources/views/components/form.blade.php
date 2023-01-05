@props([
    'method' => 'POST',
    'action',
    'hasFiles' => false,
    'model'
])

@php
    $method = strtoupper($method);
@endphp
<div class="card">
    <form class="card-body" method="{{ $method !== 'GET' ? 'POST' : $method }}"
          action="{{ $action }}" {!! $hasFiles ? 'enctype="multipart/form-data"' : '' !!} {{ $attributes }}>
        @csrf
        @if (!in_array($method, ['POST', 'GET']))
            @method($method)
        @endif
        {{ $slot }}
    </form>
</div>