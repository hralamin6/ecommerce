<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Support\Carbon;
    use App\Models\Scopes\Searchable;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
 * App\Models\Work
 *
 * @property int                           $id
 * @property string|null                   $url
 * @property string|null                   $file
 * @property string|null                   $notes
 * @property string|null                   $type
 * @property int                           $duration
 * @property int                           $price
 * @property bool                          $status
 * @property Carbon|null                   $created_at
 * @property Carbon|null                   $updated_at
 * @property-read string                   $file_url
 * @property-read Collection|Transaction[] $transections
 * @property-read int|null                 $transections_count
 * @method static Builder|Work newModelQuery()
 * @method static Builder|Work newQuery()
 * @method static Builder|Work query()
 * @method static Builder|Work search($search)
 * @method static Builder|Work searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static Builder|Work whereCreatedAt($value)
 * @method static Builder|Work whereDuration($value)
 * @method static Builder|Work whereFile($value)
 * @method static Builder|Work whereId($value)
 * @method static Builder|Work whereNotes($value)
 * @method static Builder|Work wherePrice($value)
 * @method static Builder|Work whereStatus($value)
 * @method static Builder|Work whereType($value)
 * @method static Builder|Work whereUpdatedAt($value)
 * @method static Builder|Work whereUrl($value)
 * @mixin Eloquent
 * @property-read Collection|Transaction[] $transactions
 * @property-read int|null                 $transactions_count
 */
    class Work extends Model
    {
        use HasFactory, Searchable;

        protected $fillable = ['url', 'type', 'file', 'duration', 'price', 'notes', 'status'];

        protected $searchableFields = ['*'];

        protected $casts
            = [
                'status' => 'boolean',
            ];

        protected $appends = ['file_url'];

        public function getFileUrlAttribute(): string
        {
            return asset($this->file);

        }

        public function transactions(): HasMany
        {
            return $this->hasMany(Transaction::class);
        }
    }
