<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Support\Carbon;
    use App\Models\Scopes\Searchable;
    use Database\Factories\SliderFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
 * App\Models\Slider
 *
 * @property int         $id
 * @property string|null $title
 * @property string|null $subtitle
 * @property string|null $action
 * @property string|null $image
 * @property bool|null   $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static SliderFactory factory(...$parameters)
 * @method static Builder|Slider newModelQuery()
 * @method static Builder|Slider newQuery()
 * @method static Builder|Slider query()
 * @method static Builder|Slider search($search)
 * @method static Builder|Slider searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static Builder|Slider whereAction($value)
 * @method static Builder|Slider whereCreatedAt($value)
 * @method static Builder|Slider whereId($value)
 * @method static Builder|Slider whereImage($value)
 * @method static Builder|Slider whereStatus($value)
 * @method static Builder|Slider whereSubtitle($value)
 * @method static Builder|Slider whereTitle($value)
 * @method static Builder|Slider whereUpdatedAt($value)
 * @mixin Eloquent
 */
    class Slider extends Model
    {
        use HasFactory;
        use Searchable;

        protected $fillable = ['title', 'subtitle', 'action', 'image', 'status'];

        protected $searchableFields = ['*'];

        protected $casts = [
            'status' => 'boolean',
        ];
    }
