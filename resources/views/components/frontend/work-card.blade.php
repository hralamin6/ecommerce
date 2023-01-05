<button type="button" onclick='event.preventDefault();startWork(@json($item))' class="btn col-sm-6 col-lg-3 col-xl-2">
    <div class="card">
        <div class="card-body text-black-50">
                {{ $item->notes ?? "Click to start" }}
        </div>
    </div>
</button>
