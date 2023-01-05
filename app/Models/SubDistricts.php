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
 * App\Models\SubDistricts
 *
 * @property int                             $id
 * @property int                             $district_id
 * @property string                          $name
 * @property bool                            $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Districts                  $districts
 * @method static Builder|SubDistricts newModelQuery()
 * @method static Builder|SubDistricts newQuery()
 * @method static Builder|SubDistricts query()
 * @method static Builder|SubDistricts search($search)
 * @method static Builder|SubDistricts searchLatestPaginated(string $search, int $paginationQuantity = 10)
 * @method static Builder|SubDistricts whereCreatedAt($value)
 * @method static Builder|SubDistricts whereDistrictId($value)
 * @method static Builder|SubDistricts whereId($value)
 * @method static Builder|SubDistricts whereName($value)
 * @method static Builder|SubDistricts whereStatus($value)
 * @method static Builder|SubDistricts whereUpdatedAt($value)
 * @mixin Eloquent
 */
    class SubDistricts extends Model
    {
        use HasFactory;
        use Searchable;

        protected $fillable = ['districts_id', 'name', 'status'];

        protected $searchableFields = ['name'];

        protected $table = 'sub_districts';

        protected $casts = [
            'status' => 'boolean',
        ];

        public function districts(): BelongsTo
        {
            return $this->belongsTo(Districts::class, 'district_id', 'id')->select(['id', 'name']);
        }
    }
