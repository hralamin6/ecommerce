<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Support\Carbon;
    use App\Models\Scopes\Searchable;
    use Database\Factories\BrandFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
 * App\Models\Brand
 *
 * @property int                        $id
 * @property string                     $name
 * @property string                     $logo
 * @property bool                       $status
 * @property string                     $slug
 * @property Carbon|null                $created_at
 * @property Carbon|null                $updated_at
 * @property-read Collection|Products[] $allProducts
 * @property-read int|null              $all_products_count
 * @method static BrandFactory factory(...$parameters)
 * @method static Builder|Brand newModelQuery()
 * @method static Builder|Brand newQuery()
 * @method static Builder|Brand query()
 * @method static Builder|Brand search($search)
 * @method static Builder|Brand searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static Builder|Brand whereCreatedAt($value)
 * @method static Builder|Brand whereId($value)
 * @method static Builder|Brand whereLogo($value)
 * @method static Builder|Brand whereName($value)
 * @method static Builder|Brand whereSlug($value)
 * @method static Builder|Brand whereStatus($value)
 * @method static Builder|Brand whereUpdatedAt($value)
 * @mixin Eloquent
 */
    class Brand extends Model
    {
        use HasFactory;
        use Searchable;

        protected $fillable = ['name', 'logo', 'status', 'slug'];

        protected $searchableFields = ['*'];

        protected $casts = [
            'status' => 'boolean',
        ];

        public function allProducts()
        {
            return $this->hasMany(Products::class);
        }
    }
