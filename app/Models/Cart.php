<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Cart
 *
 * @property int                $id
 * @property int|null           $user_id
 * @property int                $products_id
 * @property string|null        $temp_id
 * @property float              $price
 * @property int|null           $quantity
 * @property float              $discount
 * @property Carbon|null        $created_at
 * @property Carbon|null        $updated_at
 * @property-read Products|null $products
 * @method static Builder|Cart newModelQuery()
 * @method static Builder|Cart newQuery()
 * @method static Builder|Cart query()
 * @method static Builder|Cart whereCreatedAt($value)
 * @method static Builder|Cart whereDiscount($value)
 * @method static Builder|Cart whereId($value)
 * @method static Builder|Cart wherePrice($value)
 * @method static Builder|Cart whereProductsId($value)
 * @method static Builder|Cart whereQuantity($value)
 * @method static Builder|Cart whereTempId($value)
 * @method static Builder|Cart whereUpdatedAt($value)
 * @method static Builder|Cart whereUserId($value)
 * @mixin Eloquent
 * @property string|null        $sku
 * @method static Builder|Cart whereSku($value)
 */
class Cart extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'products_id', 'temp_id', 'price', 'quantity', 'discount', 'sku' ];
    protected $casts = [ 'price' => 'double', 'quantity' => 'integer' ];

    public function products (): HasOne
    {
        return $this->hasOne (Products::class, 'id', 'products_id')->select ([ 'id', 'name', 'slug', 'point', 'purchase_price', 'thumbnail_img', 'is_variant' ]);
    }
}
