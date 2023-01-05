<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Districts;
use Illuminate\Auth\Access\HandlesAuthorization;

class DistrictsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the districts can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the districts can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Districts  $model
     * @return mixed
     */
    public function view(User $user, Districts $model)
    {
        return true;
    }

    /**
     * Determine whether the districts can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the districts can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Districts  $model
     * @return mixed
     */
    public function update(User $user, Districts $model)
    {
        return true;
    }

    /**
     * Determine whether the districts can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Districts  $model
     * @return mixed
     */
    public function delete(User $user, Districts $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Districts  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the districts can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Districts  $model
     * @return mixed
     */
    public function restore(User $user, Districts $model)
    {
        return false;
    }

    /**
     * Determine whether the districts can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Districts  $model
     * @return mixed
     */
    public function forceDelete(User $user, Districts $model)
    {
        return false;
    }
}
