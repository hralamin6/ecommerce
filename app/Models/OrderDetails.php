<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Support\Carbon;
    use App\Models\Scopes\Searchable;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Builder;
    use Database\Factories\OrderDetailsFactory;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
 * App\Models\OrderDetails
 *
 * @property int           $id
 * @property int           $orders_id
 * @property int           $products_id
 * @property string        $price
 * @property int           $quantity
 * @property Carbon|null   $created_at
 * @property Carbon|null   $updated_at
 * @property-read Orders   $orders
 * @property-read Products $products
 * @method static OrderDetailsFactory factory(...$parameters)
 * @method static Builder|OrderDetails newModelQuery()
 * @method static Builder|OrderDetails newQuery()
 * @method static Builder|OrderDetails query()
 * @method static Builder|OrderDetails search($search)
 * @method static Builder|OrderDetails searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static Builder|OrderDetails whereCreatedAt($value)
 * @method static Builder|OrderDetails whereId($value)
 * @method static Builder|OrderDetails whereOrdersId($value)
 * @method static Builder|OrderDetails wherePrice($value)
 * @method static Builder|OrderDetails whereProductsId($value)
 * @method static Builder|OrderDetails whereQuantity($value)
 * @method static Builder|OrderDetails whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string|null $sku
 * @method static Builder|OrderDetails whereSku($value)
 */
    class OrderDetails extends Model
    {
        use HasFactory;
        use Searchable;

        protected $fillable = ['orders_id', 'products_id', 'price', 'quantity', 'sku'];

        protected $searchableFields = ['*'];

        protected $table = 'order_details';

        public function orders()
        {
            return $this->belongsTo(Orders::class);
        }

        public function products()
        {
            return $this->belongsTo(Products::class);
        }
    }
