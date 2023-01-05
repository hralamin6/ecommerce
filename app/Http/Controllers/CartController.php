<?php

namespace App\Http\Controllers;


use App\Helper;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use function auth;

class CartController extends Controller
{


    public function index (Request $request)
    {
        $carts = Helper::getCartTotal ();
        return view ('web.pages.checkout.cart', compact ('carts',));
    }

    public function addToCart (Request $request): JsonResponse
    {

        $data = [];
        $product = Products::query ()->find ($request->get ('id'));
        $variant = $request->variant;
        if ($product->is_variant && $variant == null) return response ()->json ([ 'message' => 'Please select all available options!' ]);
        if ($product->is_variant && $variant != null) {
            $variantProduct = $product->variations ()->whereSku ($variant)->first ();
            if ($variantProduct == null) return response ()->json ([ 'message' => 'Please select all available options!' ]);
            $data['sku'] = $variantProduct->sku;
        }
        if (auth ()->user () != null) {
            $user = auth ()->user ()->id;
            $data['user_id'] = $user;
        } else {
            if ($request->session ()->get ('temp_id')) {
                $temp_id = $request->session ()->get ('temp_id');
            } else {
                $temp_id = bin2hex (random_bytes (10));
                $request->session ()->put ('temp_id', $temp_id);
            }
            $data['temp_id'] = $temp_id;
        }
        $carts = auth ()->check () ? Cart::query ()->whereUserId ($user) : Cart::query ()->whereTempId ($temp_id);
        $data['products_id'] = $product->id;
        $price = $product->is_variant && $variant != null ? $variantProduct->price : $product->sale_price;
        if ($product->is_flash || ($product->discount > 0)) $price = $product->discount_type == 'percentage' ? $price - ($price * $product->discount) / 100 : $price - $product->discount;
        $data['quantity'] = $request->get ('quantity');
        $data['price'] = $price;
//        cart has products already
        if ($carts->count ('id') > 0) {
            $foundInCart = $carts->where ('products_id', $product->id)
                ->when ($product->is_variant, function ($query) use ($variant) {
                    $query->whereSku ($variant);
                })
                ->first ();
//            is in cart
            if ($foundInCart !== null) {
                $stock = $product->is_variant ? $variantProduct->quantity : $product->stock;
                if ($stock < ($foundInCart->quantity + ($request->quantity ?? 1))) return response ()->json ([ 'message' => 'Out of stock!' ]);

                $foundInCart->increment ('quantity', $request->quantity ?? 1);
                $product->decrement ('stock', $request->quantity ?? 1);
                $foundInCart->save ();

//                not in cart
            } else {
                $cart = Cart::create ($data);
                $cart->products->is_variant ? $cart->products->variations ()->whereSku ($cart->sku)->first ()->decrement ('quantity') : $cart->products ()->decrement ('stock');

            }
//            fresh cart
        } else {
            $cart = Cart::create ($data);
            $cart->products->is_variant ? $cart->products->variations ()->whereSku ($cart->sku)->first ()->decrement ('quantity') : $cart->products ()->decrement ('stock');


        }
        $carts = Helper::getCartTotal ();
        return response ()->json ([ 'message' => "$product->name added to cart!", 'count' => $carts['count'], view ('web.partials.cartlist', compact ('carts')) ]);

    }

    //removes from Cart
    public function removeFromCart (Request $request): JsonResponse
    {

        $carts = auth ()->check () ? Cart::whereUserId (auth ()->user ()->id) : Cart::whereTempId ($request->session ()->get ('temp_id'));
        $carts = $carts->where ('products_id', $request->id)->first ();
        $carts->products->is_variant ? $carts->products->variations ()->whereSku ($carts->sku)->first ()->increment ('quantity', $carts->quantity) : $carts->products ()->increment ('stock', $carts->quantity);

        $carts->delete ();
        $carts = Helper::getCartTotal ();
        return response ()->json ([ 'message' => "Removed from cart!", 'view' => view ('web.partials.cartlist', compact ('carts'))->render (), 'count' => $carts['count'], 'total' => $carts['total'] ]);
    }


    public function updateQuantity (Request $request): JsonResponse
    {
        $cart = Cart::find ($request->cart);
        if (isset($cart)) {
            $quantity = $cart->products->stock;
            if ($quantity >= $request->quantity) $cart->update ([ 'quantity' => $request->quantity ]);
        }
        $carts = Helper::getCartTotal ();
        return response ()->json ([ 'message' => "Cart updated!", 'view' => view ('web.partials.cartlist', compact ('carts'))->render (), 'count' => $carts['count'], 'total' => $carts['total'] ]);


    }

    public function incrementQuantity (Request $request): JsonResponse
    {
        $cart = Cart::query ()->find ($request->cart);
        if (isset($cart)) {
            $product = $cart->products->is_variant ? $cart->products->variations ()->whereSku ($cart->sku)->first () : $cart->products;
            $quantity = $product->is_variant ? $product->quantity : $product->stock;
            if ($quantity < $request->quantity) {
                return response ()->json ([ 'message' => "Out of stock" ]);
            }
            $cart->increment ('quantity');
            $product->is_variant ? $product->decrement ('quantity') : $product()->decrement ('stock');
        }
        $carts = Helper::getCartTotal ();
        return response ()->json ([ 'message' => "Cart updated!", 'view' => view ('web.partials.cartlist', compact ('carts'))->render (), 'count' => $carts['count'], 'total' => $carts['total'] ]);
    }

    public function decrementQuantity (Request $request): JsonResponse
    {
        $cart = Cart::query ()->find ($request->cart);
        if (isset($cart)) {
            $cart->decrement ('quantity');
            $cart->products->is_variant ? $cart->products->variations ()->whereSku ($cart->sku)->first ()->increment ('quantity') : $cart->products->increment ('stock');
            if ($cart->quantity == 0) $cart->delete ();

        }
        $carts = Helper::getCartTotal ();
        return response ()->json ([ 'message' => "Cart updated!", 'view' => view ('web.partials.cartlist', compact ('carts'))->render (), 'count' => $carts['count'], 'total' => $carts['total'] ]);
    }
}
