<!-- Cart Area-->
<div class="cart-table card mb-3">
    <div class="table-responsive card-body">
        <table class="table mb-0">
            <tbody>
                @each('components.frontend.cartitem', $carts['cart'], 'item','partials.no-item')
            </tbody>
        </table>
    </div>
</div>