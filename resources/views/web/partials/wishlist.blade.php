<div class="section-heading d-flex align-items-center justify-content-between">
    <h6>Your Wishlist ({{ $wishlists->count() }})</h6>
</div>
<div class="row g-3">
    @each('partials.wishlist-item', $wishlists, 'item', 'partials.no-item')
</div>