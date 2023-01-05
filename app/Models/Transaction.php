<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Support\Carbon;
    use App\Models\Scopes\Searchable;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
 * App\Models\Transaction
 *
 * @property int            $id
 * @property int            $user_id
 * @property int|null       $work_id
 * @property int|null       $order_id
 * @property string|null    $type
 * @property string         $amount
 * @property string|null    $note
 * @property bool           $status
 * @property Carbon|null    $created_at
 * @property Carbon|null    $updated_at
 * @property-read User      $user
 * @property-read Work|null $work
 * @method static Builder|Transaction newModelQuery()
 * @method static Builder|Transaction newQuery()
 * @method static Builder|Transaction query()
 * @method static Builder|Transaction search($search)
 * @method static Builder|Transaction searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static Builder|Transaction whereAmount($value)
 * @method static Builder|Transaction whereCreatedAt($value)
 * @method static Builder|Transaction whereId($value)
 * @method static Builder|Transaction whereNote($value)
 * @method static Builder|Transaction whereOrderId($value)
 * @method static Builder|Transaction whereStatus($value)
 * @method static Builder|Transaction whereType($value)
 * @method static Builder|Transaction whereUpdatedAt($value)
 * @method static Builder|Transaction whereUserId($value)
 * @method static Builder|Transaction whereWorkId($value)
 * @mixin Eloquent
 */
    class Transaction extends Model
    {
        use HasFactory;
        use Searchable;

        protected $fillable = ['user_id', 'work_id', 'amount', 'note', 'type', 'status'];

        protected $searchableFields = ['*'];

        protected $casts = [
            'status' => 'boolean'
        ];

        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class)->withDefault(['name' => 'Not specified']);
        }

        public function work(): BelongsTo
        {
            return $this->belongsTo(Work::class);
        }

    }
