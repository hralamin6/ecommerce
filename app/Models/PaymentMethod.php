<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Support\Carbon;
    use App\Models\Scopes\Searchable;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
 * App\Models\PaymentMethod
 *
 * @method static Builder|PaymentMethod newModelQuery()
 * @method static Builder|PaymentMethod newQuery()
 * @method static Builder|PaymentMethod query()
 * @method static Builder|PaymentMethod search($search)
 * @method static Builder|PaymentMethod searchLatestPaginated(string $search, int $paginationQuantity = 10)
 * @mixin Eloquent
 * @property int         $id
 * @property string      $number
 * @property string      $type
 * @property bool        $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PaymentMethod whereCreatedAt($value)
 * @method static Builder|PaymentMethod whereId($value)
 * @method static Builder|PaymentMethod whereNumber($value)
 * @method static Builder|PaymentMethod whereStatus($value)
 * @method static Builder|PaymentMethod whereType($value)
 * @method static Builder|PaymentMethod whereUpdatedAt($value)
 */
    class PaymentMethod extends Model
    {
        use HasFactory;
        use Searchable;

        protected $fillable = ['number', 'type', 'status'];

        protected $searchableFields = ['*'];

        protected $casts = [
            'status' => 'boolean',
        ];
    }
