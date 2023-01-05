@props([
    'src',
    'size' => 50,
])

@if($src)
<img src="{{ $src }}" class="border rounded" style="width: {{ $width ?? $size }}px; height: {{ $height ?? $size }}px; object-fit: cover;">
@else
<div class="border rounded bg-light" style="width: {{ $width ?? $size }}px; height: {{ $size }}px;"></div>
@endif