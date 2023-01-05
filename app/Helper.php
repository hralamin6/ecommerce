<?php


namespace App;


use App\Models\Cart;
use App\Models\User;
use App\Models\Wishlists;
use Illuminate\Support\Str;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;


class Helper
{
    /**
     * Generate user avatar url
     *
     * @return string
     */
    public static function getUserAvatar (): string
    {
        return (auth ()->user () && auth ()->user ()->avatar) ? asset (auth ()->user ()->avatar) : asset ('frontend/img/user/avatar.png');
    }

    /**
     * Generate point html for frontend
     *
     * @param $point
     *
     * @return string
     */
    public static function getPointHtml ($point): string
    {
        return sprintf ("%s %s", $point, Str::plural ('point', $point));
    }

    /**
     * Format single price to html price
     *
     * @param        $sale_price
     * @param        $discount
     * @param        $discount_type
     * @param string $class
     *
     * @return string
     */
    public static function formatSinglePrice ($sale_price, $discount, $discount_type, string $class = 'real-price'): string
    {

        if ($discount > 0) {
            if ($discount_type == 'amount') $price = sprintf ("৳ %d<span class='%s'> ৳ %d</span>", (int)$sale_price - (int)$discount, $class, (int)$sale_price);
            else {
                $discountAmount = $sale_price * ($discount / 100);
                $price = sprintf ("৳ %d<span class='%s'> ৳ %d</span>", (int)$sale_price - $discountAmount, $class, (int)$sale_price);
            }
        } else {
            $price = self::counter_price ($sale_price);
        }
        return $price;
    }

    /**
     * Generate price html as counter up
     *
     * @param       $price
     * @param false $counter
     *
     * @return string
     */
    public static function counter_price ($price, bool $counter = false): string
    {
        return $counter ? "৳ <span class='counter'>$price</span> " : "৳ $price";
    }

    /**
     * Generate thumbnail image url
     *
     * @param $thumbnail_img
     *
     * @return string
     */
    public static function getProductImage ($thumbnail_img): string
    {
        return $thumbnail_img ? asset ($thumbnail_img) : asset ('frontend/img/product/1.png');
    }

    /**
     * Generate slider image url
     *
     * @param $image
     *
     * @return string
     */
    public static function getSliderImage ($image): string
    {
        return $image ? asset ($image) : asset ('frontend/img/bg-img/1.jpg');

    }

    /**
     * generate sku from choice option
     *
     * @param $arrays
     *
     * @return array|array[]
     */
    public static function makeCombinations ($arrays): array
    {
        $result = [ [] ];
        foreach ($arrays as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge ($result_item, [ $property => $property_value ]);
                }
            }
            $result = $tmp;
        }
        return $result;
    }

    /**
     * Get total cart object and calculate cart total
     *
     * @return array
     */
    public static function getCartTotal (): array
    {
        $cart = Cart::latest ()->with ('products');
        if (auth ()->check ()) {
            $cart = $cart->where ('user_id', auth ()->user ()->id)->get ();
        } else {
            if (session ()->has ('temp_id')) $cart = $cart->where ('temp_id', session ()->get ('temp_id'))->get ();
            else $cart = [];
        }
        $total = 0;
        $count = 0;
        if (!empty($cart)) {
            foreach ($cart as $item) $total += ($item->price * $item->quantity);
            $count = count ($cart);
        }
        return [ 'total' => ceil ($total), 'cart' => $cart, 'count' => $count ];
    }

    /**
     * Calculate wishlist total
     *
     * @return array
     */
    public static function getWishlistCount (): array
    {
        $wishlists = auth ()->check () ? Wishlists::query ()->where ('wishlists.user_id', auth ()->user ()->id)->get () : [];
        return [ 'wishlists' => $wishlists, 'count' => count ($wishlists) ];
    }

    /**
     * Generate rating html from product rating
     *
     * @param $rating
     *
     * @return string
     */
    public static function ratingHtml ($rating): string
    {
        $html = '';
        for ($i = 1; $i < 6; $i++) $html = ($i <= round ($rating, 0, PHP_ROUND_HALF_UP)) ? $html . '<i class="lni lni-star-filled"></i>' : $html . '<i class="lni lni-star"></i>';
        return $html;

    }

    /**
     * Generate Rank based on direct refer
     *
     * @return string
     */
    public static function generateRank (): string
    {
        $refCount = self::generateLevel ();
        for ($i = 0; $i <= 10; $i++) {
            if (array_key_exists ($i, $refCount)) {
                if (count ($refCount[$i]) < 15) return "No Rank Yet!";

                if (count ($refCount[$i]) >= 15) return "Recruiting officer";

                if (count ($refCount[$i]) > 15 && count ($refCount[$i]) >= 250) return "Junior Marketing Officer";

                if (count ($refCount[$i]) > 250 && count ($refCount[$i]) >= 750) return "Marketing Officer";

                if (count ($refCount[$i]) > 750 && count ($refCount[$i]) >= 2250) return "Senior Marketing Officer";

                if (count ($refCount[$i]) > 2250 && count ($refCount[$i]) >= 6750) return "Area Manager";

                if (count ($refCount[$i]) > 6750 && count ($refCount[$i]) >= 20250) return "Marketing Director";

                if (count ($refCount[$i]) > 20250 && count ($refCount[$i]) >= 60750) return "Vice Presidential Marketing Director";

                if (count ($refCount[$i]) > 60750 && count ($refCount[$i]) >= 182250) return "Presidential Marketing Director";
            }
        }

        return "No Rank Yet!";

    }

    public static function generateLevel (): array
    {
        $refers = auth ()->user ()->directRefer ()->select ([ 'id', 'username', 'name' ])->get ()->toArray ();

        $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($refers));
        foreach ($it as $key => $element) {
            if ($key == 'username') {
                $level[$it->getDepth ()][] = $element;
            }
        }

        return array_values ($level ?? []);
    }

    public static function giveBonusToUsers ($orders)
    {
        $reward = collect ($orders->allOrderDetails)->map (function ($item, $key) {
            return $item->products->point * $item->quantity;
        })->sum ();

        if ($reward > 0) {
            $bonus = $reward / 10;
            $orders->user->increment ('point', $bonus);
            $orders->user->transactions ()->create ([ 'type' => 'product reward', 'amount' => $bonus, 'note' => __ ('bonus.shop.product_reward') ]);
            $rest = self::generationBonus ($orders->user, $bonus, __ ('bonus.shop.purchase_reward', [ 'user' => $orders->user->username ]), 'purchase reward', 'point');
            if ($rest > 0) {
                $bonus_remain = $rest * $bonus;
                $admin = User::whereUsername ('officialadmin')->first ();
                $admin->increment ('point', $bonus_remain);
                $admin->transactions ()->create ([ 'type' => 'purchase reward', 'amount' => $bonus_remain, 'note' => __ ('bonus.shop.purchase_reward_remain', [ 'user' => $orders->user->username ]) ]);
            }
        }
    }

    /**
     * Give generation bonus
     *
     * @param      $user    "for whom bonus will generate"
     * @param      $amount  "how much referrer will receive"
     * @param      $message "message for transaction ledger"
     * @param      $type    "type of transaction"
     * @param      $column  "increment column"
     *
     * @return int
     */
    public static function generationBonus ($user, $amount, $message, $type, $column): int
    {


        $referral = $user;

        $skipped = 0;

        for ($i = 2; $i <= 9; $i++) {

            $referral = User::query ()->firstWhere ('username', $referral->referral_user);
            if (isset($referral)) {
                $count = $referral->directRefer ()->count ();
                if ($count >= $i) {
                    $referral->increment ($column, $amount);
                    $referral->transactions ()->create ([ 'type' => $type, 'amount' => $amount, 'note' => $message ]);
                } else $skipped++;


            } else break;
        }
        return (9 - ($i - 2)) + $skipped;
    }

    public static function getProductStock ($product)
    {
        if ($product->is_variant) {
            return $product->variations ()->sum ('quantity');
        }
        return $product->stock;
    }
}
