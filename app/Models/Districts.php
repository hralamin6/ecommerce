<?php

    namespace App\Models;

    use App\Models\Scopes\Searchable;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
 * App\Models\Districts
 *
 * @property int $id
 * @property string $name
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubDistricts[] $allSubDistricts
 * @property-read int|null $all_sub_districts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Districts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Districts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Districts query()
 * @method static \Illuminate\Database\Eloquent\Builder|Districts search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts searchLatestPaginated(string $search, int $paginationQuantity = 10)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Districts extends Model
    {
        use HasFactory;
        use Searchable;

        protected $fillable = ['name', 'status'];

        protected $searchableFields = ['name'];

        protected $casts = [
            'status' => 'boolean',
        ];

        public function allSubDistricts(): HasMany
        {
            return $this->hasMany(SubDistricts::class);
        }
    }
