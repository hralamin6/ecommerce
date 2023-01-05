<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Support\Carbon;
    use App\Models\Scopes\Searchable;
    use Database\Factories\OrdersFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
 * App\Models\Orders
 *
 * @property int                            $id
 * @property int|null                       $user_id
 * @property string                         $code
 * @property string                         $shipping_address
 * @property string                         $delivery_status
 * @property string                         $payment_type
 * @property string                         $payment_status
 * @property string                         $grand_total
 * @property float                          $coupon_discount
 * @property float                          $commission
 * @property float                          $shipping_cost
 * @property string                         $shipping_district
 * @property string|null                    $trx
 * @property string|null                    $payment_number
 * @property int                            $viewed
 * @property Carbon|null                    $created_at
 * @property Carbon|null                    $updated_at
 * @property-read Collection|OrderDetails[] $allOrderDetails
 * @property-read int|null                  $all_order_details_count
 * @property-read User|null                 $user
 * @method static OrdersFactory factory(...$parameters)
 * @method static Builder|Orders newModelQuery()
 * @method static Builder|Orders newQuery()
 * @method static Builder|Orders query()
 * @method static Builder|Orders search($search)
 * @method static Builder|Orders searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static Builder|Orders whereCode($value)
 * @method static Builder|Orders whereCommission($value)
 * @method static Builder|Orders whereCouponDiscount($value)
 * @method static Builder|Orders whereCreatedAt($value)
 * @method static Builder|Orders whereDeliveryStatus($value)
 * @method static Builder|Orders whereGrandTotal($value)
 * @method static Builder|Orders whereId($value)
 * @method static Builder|Orders wherePaymentNumber($value)
 * @method static Builder|Orders wherePaymentStatus($value)
 * @method static Builder|Orders wherePaymentType($value)
 * @method static Builder|Orders whereShippingAddress($value)
 * @method static Builder|Orders whereShippingCost($value)
 * @method static Builder|Orders whereShippingDistrict($value)
 * @method static Builder|Orders whereTrx($value)
 * @method static Builder|Orders whereUpdatedAt($value)
 * @method static Builder|Orders whereUserId($value)
 * @method static Builder|Orders whereViewed($value)
 * @mixin Eloquent
 */
    class Orders extends Model
    {
        use HasFactory;
        use Searchable;

        protected $guarded = [];

        protected $searchableFields = ['*'];
        protected $casts = [
            'created_at' => 'datetime'
        ];

        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }

        public function allOrderDetails(): HasMany
        {
            return $this->hasMany(OrderDetails::class)->with('products:id,name,thumbnail_img,slug,point');
        }
    }
