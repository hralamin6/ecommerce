<div
    role="group"
    aria-label="Row Actions"
    class="btn-group"
>

        <a href="{{ route('users.edit', $id) }}">
            <button
                type="button"
                class="btn btn-light"
            >
                <i class="icon fas fa-edit fa-sm"></i>
            </button>
        </a>

        <a href="{{ route('users.show', $id) }}">
            <button
                type="button"
                class="btn btn-light"
            >
                <i class="icon fas fa-eye fa-sm"></i>
            </button>
        </a>


</div>
