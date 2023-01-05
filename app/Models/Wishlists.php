<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Database\Eloquent\Model;
    use Database\Factories\WishlistsFactory;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
 * App\Models\Wishlists
 *
 * @property int|null       $user_id
 * @property int            $products_id
 * @property-read Products  $products
 * @property-read User|null $user
 * @method static WishlistsFactory factory(...$parameters)
 * @method static Builder|Wishlists newModelQuery()
 * @method static Builder|Wishlists newQuery()
 * @method static Builder|Wishlists query()
 * @method static Builder|Wishlists whereProductsId($value)
 * @method static Builder|Wishlists whereUserId($value)
 * @mixin Eloquent
 */
    class Wishlists extends Model
    {
        use HasFactory;

        public $timestamps = false;
        protected $fillable = ['user_id', 'products_id'];

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function products()
        {
            return $this->belongsTo(Products::class);
        }
    }
