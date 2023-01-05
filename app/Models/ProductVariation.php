<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\ProductVariation
 *
 * @method static Builder|ProductVariation newModelQuery()
 * @method static Builder|ProductVariation newQuery()
 * @method static Builder|ProductVariation query()
 * @mixin \Eloquent
 * @property int                             $id
 * @property int                             $products_id
 * @property int                             $quantity
 * @property string                          $sku
 * @property float                           $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|ProductVariation whereCreatedAt($value)
 * @method static Builder|ProductVariation whereId($value)
 * @method static Builder|ProductVariation wherePrice($value)
 * @method static Builder|ProductVariation whereProductId($value)
 * @method static Builder|ProductVariation whereSku($value)
 * @method static Builder|ProductVariation whereStock($value)
 * @method static Builder|ProductVariation whereUpdatedAt($value)
 * @property-read \App\Models\Products       $product
 * @method static Builder|ProductVariation whereProductsId($value)
 * @method static Builder|ProductVariation whereQuantity($value)
 */
class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = [ 'products_id', 'sku', 'price', 'quantity' ];

    public function product (): BelongsTo
    {
        return $this->belongsTo (Products::class);
    }
}
