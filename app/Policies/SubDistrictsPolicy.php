<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SubDistricts;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubDistrictsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the subDistricts can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the subDistricts can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubDistricts  $model
     * @return mixed
     */
    public function view(User $user, SubDistricts $model)
    {
        return true;
    }

    /**
     * Determine whether the subDistricts can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the subDistricts can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubDistricts  $model
     * @return mixed
     */
    public function update(User $user, SubDistricts $model)
    {
        return true;
    }

    /**
     * Determine whether the subDistricts can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubDistricts  $model
     * @return mixed
     */
    public function delete(User $user, SubDistricts $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubDistricts  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the subDistricts can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubDistricts  $model
     * @return mixed
     */
    public function restore(User $user, SubDistricts $model)
    {
        return false;
    }

    /**
     * Determine whether the subDistricts can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubDistricts  $model
     * @return mixed
     */
    public function forceDelete(User $user, SubDistricts $model)
    {
        return false;
    }
}
