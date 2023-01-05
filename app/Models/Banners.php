<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Support\Carbon;
    use App\Models\Scopes\Searchable;
    use Database\Factories\BannersFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
 * App\Models\Banners
 *
 * @property int         $id
 * @property string      $title
 * @property string      $sub_title
 * @property string      $url
 * @property string|null $photo
 * @property int         $position
 * @property bool        $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static BannersFactory factory(...$parameters)
 * @method static Builder|Banners newModelQuery()
 * @method static Builder|Banners newQuery()
 * @method static Builder|Banners query()
 * @method static Builder|Banners search($search)
 * @method static Builder|Banners searchLatestPaginated(string $search, string $paginationQuantity = 10)
 * @method static Builder|Banners whereCreatedAt($value)
 * @method static Builder|Banners whereId($value)
 * @method static Builder|Banners wherePhoto($value)
 * @method static Builder|Banners wherePosition($value)
 * @method static Builder|Banners whereStatus($value)
 * @method static Builder|Banners whereSubTitle($value)
 * @method static Builder|Banners whereTitle($value)
 * @method static Builder|Banners whereUpdatedAt($value)
 * @method static Builder|Banners whereUrl($value)
 * @mixin Eloquent
 */
    class Banners extends Model
    {
        use HasFactory;
        use Searchable;

        protected $fillable = [
            'title',
            'sub_title',
            'url',
            'photo',
            'position',
            'status',
        ];

        protected $searchableFields = ['*'];

        protected $casts = [
            'status' => 'boolean',
        ];


    }
