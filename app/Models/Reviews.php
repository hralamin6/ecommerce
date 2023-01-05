<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Support\Carbon;
    use App\Models\Scopes\Searchable;
    use Database\Factories\ReviewsFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
 * App\Models\Reviews
 *
 * @property int            $id
 * @property int|null       $user_id
 * @property int            $products_id
 * @property int            $rating
 * @property string|null    $comment
 * @property bool           $status
 * @property bool           $viewed
 * @property Carbon|null    $created_at
 * @property Carbon|null    $updated_at
 * @property-read Products  $products
 * @property-read User|null $user
 * @method static ReviewsFactory factory(...$parameters)
 * @method static Builder|Reviews newModelQuery()
 * @method static Builder|Reviews newQuery()
 * @method static Builder|Reviews query()
 * @method static Builder|Reviews search($search)
 * @method static Builder|Reviews searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static Builder|Reviews whereComment($value)
 * @method static Builder|Reviews whereCreatedAt($value)
 * @method static Builder|Reviews whereId($value)
 * @method static Builder|Reviews whereProductsId($value)
 * @method static Builder|Reviews whereRating($value)
 * @method static Builder|Reviews whereStatus($value)
 * @method static Builder|Reviews whereUpdatedAt($value)
 * @method static Builder|Reviews whereUserId($value)
 * @method static Builder|Reviews whereViewed($value)
 * @mixin Eloquent
 */
    class Reviews extends Model
    {
        use HasFactory;
        use Searchable;

        protected $fillable = [
            'user_id',
            'products_id',
            'rating',
            'comment',
            'status',
            'viewed',
        ];

        protected $searchableFields = ['*'];

        protected $hidden = ['viewed'];

        protected $casts = [
            'status' => 'boolean',
            'viewed' => 'boolean',
        ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function products()
        {
            return $this->belongsTo(Products::class);
        }
    }
