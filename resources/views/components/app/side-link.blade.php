@props(['class','href','icon','text'])

<li class="{{ $class }}">
    <a class="nav-link" href="{{ $href }}">
        <i class="fas fa-{{ $icon ?? 'users' }}"></i>
        <span>{{ $text }}</span>
    </a>
</li>
