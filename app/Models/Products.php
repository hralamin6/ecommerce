<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use App\Models\Scopes\Searchable;
use Database\Factories\ProductsFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Products
 *
 * @property int                            $id
 * @property int                            $category_id
 * @property int|null                       $brand_id
 * @property string                         $name
 * @property string|null                    $slug
 * @property string|null                    $description
 * @property string|null                    $thumbnail_img
 * @property array|null                     $gallery
 * @property float                          $sale_price
 * @property float                          $purchase_price
 * @property float                          $point
 * @property string|null                    $attributes
 * @property int                            $stock
 * @property string|null                    $colors
 * @property string|null                    $size
 * @property bool|null                      $status
 * @property bool|null                      $is_flash
 * @property bool|null                      $is_feature
 * @property int                            $is_variant
 * @property float|null                     $rating
 * @property int|null                       $total_sale
 * @property float|null                     $discount
 * @property string|null                    $discount_type
 * @property Carbon|null                    $created_at
 * @property Carbon|null                    $updated_at
 * @property-read Collection|OrderDetails[] $allOrderDetails
 * @property-read int|null                  $all_order_details_count
 * @property-read Collection|Reviews[]      $allReviews
 * @property-read int|null                  $all_reviews_count
 * @property-read Collection|Wishlists[]    $allWishlists
 * @property-read int|null                  $all_wishlists_count
 * @property-read Brand|null                $brand
 * @property-read Cart                      $cart
 * @property-read Category                  $category
 * @method static ProductsFactory factory(...$parameters)
 * @method static Builder|Products newModelQuery()
 * @method static Builder|Products newQuery()
 * @method static Builder|Products query()
 * @method static Builder|Products search($search)
 * @method static Builder|Products searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static Builder|Products whereAttributes($value)
 * @method static Builder|Products whereBrandId($value)
 * @method static Builder|Products whereCategoryId($value)
 * @method static Builder|Products whereColors($value)
 * @method static Builder|Products whereCreatedAt($value)
 * @method static Builder|Products whereDescription($value)
 * @method static Builder|Products whereDiscount($value)
 * @method static Builder|Products whereDiscountType($value)
 * @method static Builder|Products whereGallery($value)
 * @method static Builder|Products whereId($value)
 * @method static Builder|Products whereIsFeature($value)
 * @method static Builder|Products whereIsFlash($value)
 * @method static Builder|Products whereIsVariant($value)
 * @method static Builder|Products whereName($value)
 * @method static Builder|Products wherePoint($value)
 * @method static Builder|Products wherePurchasePrice($value)
 * @method static Builder|Products whereRating($value)
 * @method static Builder|Products whereSalePrice($value)
 * @method static Builder|Products whereSize($value)
 * @method static Builder|Products whereSlug($value)
 * @method static Builder|Products whereStatus($value)
 * @method static Builder|Products whereStock($value)
 * @method static Builder|Products whereThumbnailImg($value)
 * @method static Builder|Products whereTotalSale($value)
 * @method static Builder|Products whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string|null $sizes
 * @property-read Collection|\App\Models\ProductVariation[] $variations
 * @property-read int|null $variations_count
 * @method static Builder|Products whereSizes($value)
 */
class Products extends Model
{
    use HasFactory, Searchable;

    protected $fillable
        = [
            'category_id',
            'added_by_id',
            'brand_id',
            'name',
            'slug',
            'description',
            'thumbnail_img',
            'gallery',
            'point',
            'sale_price',
            'purchase_price',
            'stock',
            'colors',
            'sizes',
            'status',
            'is_flash',
            'is_feature',
            'is_variant',
            'rating',
            'total_sale',
            'discount',
            'discount_type',
        ];

    protected $searchableFields = [ 'name', 'description', 'sale_price', 'purchase_price' ];

    protected $casts
        = [
            'gallery'    => 'array',
            'discount'   => 'float',
            'status'     => 'boolean',
            'is_flash'   => 'boolean',
            'is_feature' => 'boolean',
        ];

    public function category (): BelongsTo
    {
        return $this->belongsTo (Category::class);
    }

    public function allReviews (): HasMany
    {
        return $this->hasMany (Reviews::class);
    }

    public function allOrderDetails (): HasMany
    {
        return $this->hasMany (OrderDetails::class);
    }

    public function allWishlists (): HasMany
    {
        return $this->hasMany (Wishlists::class);
    }

    public function brand (): BelongsTo
    {
        return $this->belongsTo (Brand::class);
    }

    public function variations (): HasMany
    {
        return $this->hasMany (ProductVariation::class);
    }

    public function cart (): BelongsTo
    {
        return $this->belongsTo (Cart::class);
    }
}
