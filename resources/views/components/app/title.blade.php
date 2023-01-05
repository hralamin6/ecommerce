@props([
    'title',
    'link'
])

    <h4 class="card-title m-0">
        @if(!empty($link))
        <a href="{{ $link }}" class="mr-4 text-decoration-none">
            <i class="icon ion-md-arrow-back"></i>
        </a>
        @endif
        @lang($title)        
    </h4>
