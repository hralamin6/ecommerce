<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Laravel\Sanctum\HasApiTokens;
use Database\Factories\UserFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\User
 *
 * @property int
 *               $id
 * @property int|null
 *               $parent_id
 * @property string|null
 *               $user_type
 * @property string|null
 *               $username
 * @property string
 *               $point
 * @property float
 *               $balance
 * @property string|null
 *               $avatar
 * @property string
 *               $name
 * @property string|null
 *               $referral_user
 * @property string
 *               $email
 * @property string|null
 *               $phone
 * @property string
 *               $password
 * @property string|null
 *               $remember_token
 * @property string|null
 *               $shipping
 * @property string|null
 *               $nid1
 * @property string|null
 *               $nid2
 * @property string|null
 *               $nid
 * @property bool
 *               $is_pending
 * @property \Illuminate\Support\Carbon|null
 *               $expired_at
 * @property \Illuminate\Support\Carbon|null
 *               $email_verified_at
 * @property \Illuminate\Support\Carbon|null
 *               $created_at
 * @property \Illuminate\Support\Carbon|null
 *               $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Orders[]
 *                    $allOrders
 * @property-read int|null
 *                    $all_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reviews[]
 *                    $allReviews
 * @property-read int|null
 *                    $all_reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wishlists[]
 *                    $allWishlists
 * @property-read int|null
 *                    $all_wishlists_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[]
 *                    $child
 * @property-read int|null
 *                    $child_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[]
 *                    $directRefer
 * @property-read int|null
 *                    $direct_refer_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[]
 *                $notifications
 * @property-read int|null
 *                    $notifications_count
 * @property-read User
 *                    $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[]
 *                    $permissions
 * @property-read int|null
 *                    $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[]
 *                    $roles
 * @property-read int|null
 *                    $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[]
 *                    $tokens
 * @property-read int|null
 *                    $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[]
 *                    $transactions
 * @property-read int|null
 *                    $transactions_count
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User permission($permissions)
 * @method static Builder|User query()
 * @method static Builder|User role($roles, $guard = null)
 * @method static Builder|User search($search)
 * @method static Builder|User searchLatestPaginated(string $search, int $paginationQuantity = 10)
 * @method static Builder|User whereAvatar($value)
 * @method static Builder|User whereBalance($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereExpiredAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereIsPending($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereNid($value)
 * @method static Builder|User whereNid1($value)
 * @method static Builder|User whereNid2($value)
 * @method static Builder|User whereParentId($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User wherePoint($value)
 * @method static Builder|User whereReferralUser($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereShipping($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereUserType($value)
 * @method static Builder|User whereUsername($value)
 * @mixin \Eloquent
 * @property int
 *               $is_blocked
 * @method static Builder|User whereIsBlocked($value)
 * @property bool
 *               $is_accepted
 * @method static Builder|User whereIsAccepted($value)
 */
class User extends Authenticatable
{
    use Notifiable, HasRoles, HasFactory, Searchable, HasApiTokens;

    protected $fillable
        = [
            "parent_id",
            "user_type",
            "username",
            "rank",
            "point",
            "balance",
            "avatar",
            "name",
            "referral_user",
            "email",
            "phone",
            "password",
            "remember_token",
            "shipping",
            "nid1",
            "nid2",
            'nid',
            "is_pending",
            "is_accepted",
            "expired_at",
            "email_verified_at",
        ];


    protected $searchableFields = [ '*' ];

    protected $hidden = [ 'password', 'remember_token' ];

    protected $casts
        = [
            'email_verified_at' => 'datetime',
            'expired_at'        => 'datetime',
            "is_pending"        => 'boolean',
            "is_accepted"       => 'boolean',
            "balance"           => 'float',
        ];

    public function directRefer (): HasMany
    {
        return $this->hasMany (User::class, 'referral_user', 'username')->where ('user_type', 'premium')->select ([ 'id', 'username', 'referral_user' ])
            ->with ('directRefer:id,username,referral_user');
    }


    public function child (): hasMany
    {
        return $this->hasMany (User::class, 'parent_id', 'id');
    }

    public function parent (): belongsTo
    {
        return $this->belongsTo (User::class, 'id', 'parent_id');
    }

    public function allReviews (): HasMany
    {
        return $this->hasMany (Reviews::class);
    }

    public function allOrders (): HasMany
    {
        return $this->hasMany (Orders::class);
    }

    public function allWishlists (): HasMany
    {
        return $this->hasMany (Wishlists::class);
    }

    public function transactions (): HasMany
    {
        return $this->hasMany (Transaction::class);
    }


    public function isSuperAdmin (): bool
    {
        return $this->hasRole ('super-admin');
    }

    public function isPremium (): bool
    {
        return $this->user_type === 'premium';
    }

    public function isAdmin (): bool
    {
        return $this->user_type === 'admin';
    }
}
