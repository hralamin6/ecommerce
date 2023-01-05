<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Support\Carbon;
    use App\Models\Scopes\Searchable;
    use Database\Factories\CouponsFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
 * App\Models\Coupons
 *
 * @property int         $id
 * @property string      $code
 * @property string      $discount
 * @property string      $discount_type
 * @property Carbon      $start
 * @property Carbon      $end
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static CouponsFactory factory(...$parameters)
 * @method static Builder|Coupons newModelQuery()
 * @method static Builder|Coupons newQuery()
 * @method static Builder|Coupons query()
 * @method static Builder|Coupons search($search)
 * @method static Builder|Coupons searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static Builder|Coupons whereCode($value)
 * @method static Builder|Coupons whereCreatedAt($value)
 * @method static Builder|Coupons whereDiscount($value)
 * @method static Builder|Coupons whereDiscountType($value)
 * @method static Builder|Coupons whereEnd($value)
 * @method static Builder|Coupons whereId($value)
 * @method static Builder|Coupons whereStart($value)
 * @method static Builder|Coupons whereUpdatedAt($value)
 * @mixin Eloquent
 */
    class Coupons extends Model
    {
        use HasFactory;
        use Searchable;

        protected $fillable = ['code', 'discount', 'discount_type', 'start', 'end'];

        protected $searchableFields = ['*'];

        protected $casts = [
            'start' => 'datetime',
            'end'   => 'datetime',
        ];
    }
