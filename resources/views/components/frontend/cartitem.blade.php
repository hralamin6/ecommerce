<tr>
    <th scope="row">
        <button onclick="removeFromCart({{$item->products_id}})"
                class="btn btn-danger btn-sm px-1 py-0 "><i class="lni lni-close"></i></button>
    </th>
    <td><img src="{{\App\Helper::getProductImage($item->products->thumbnail_img)}}" alt=""></td>
    <td>
        <a href="{{ route('shop.product', ['product'=>$item->products->slug]) }}">
            {{$item->products->name}}
            <span>{{ \App\Helper::counter_price( $item->price ) }} × {{$item->quantity}}</span>
        </a>
    </td>
    <td class="float-end">
        <form class="cart-form">
            <div class="order-plus-minus d-flex align-items-center">
                <div class="quantity-button-handler" onclick="event.preventDefault();cartDecrement('{{ $item->id }}')">
                    -
                </div>
                <input class="form-control cart-quantity-input" type="text" step="1" name="quantity"
                       value="{{$item->quantity}}" id="cart-quantity-input">
                <div class="quantity-button-handler" onclick="event.preventDefault();cartIncrement('{{ $item->id }}')">
                    +
                </div>
            </div>
        </form>

    </td>
</tr>
