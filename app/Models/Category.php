<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Support\Carbon;
    use App\Models\Scopes\Searchable;
    use Illuminate\Database\Eloquent\Model;
    use Database\Factories\CategoryFactory;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
 * App\Models\Category
 *
 * @property int                        $id
 * @property string                     $name
 * @property string|null                $slug
 * @property string|null                $image
 * @property string|null                $banner
 * @property bool|null                  $status
 * @property Carbon|null                $created_at
 * @property Carbon|null                $updated_at
 * @property-read Collection|Products[] $allProducts
 * @property-read int|null              $all_products_count
 * @method static CategoryFactory factory(...$parameters)
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category search($search)
 * @method static Builder|Category searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static Builder|Category whereBanner($value)
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereImage($value)
 * @method static Builder|Category whereName($value)
 * @method static Builder|Category whereSlug($value)
 * @method static Builder|Category whereStatus($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int|null                   $category_id
 * @method static Builder|Category whereCategoryId($value)
 * @property-read Collection|Category[] $sub_categories
 * @property-read int|null              $sub_categories_count
 * @property-read Category|null $category
 */
    class Category extends Model
    {
        use HasFactory, Searchable;

        protected $fillable = ['name', 'slug', 'image', 'banner', 'status', 'category_id'];

        protected $searchableFields = ['*'];

        protected $hidden = ['slug'];

        protected $casts
            = [
                'status' => 'boolean',
            ];

        public function allProducts(): HasMany
        {
            return $this->hasMany(Products::class);
        }

        public function category(): BelongsTo
        {
            return $this->belongsTo(Category::class);
        }

        public function sub_categories(): HasMany
        {
            return $this->hasMany(Category::class);
        }
    }
