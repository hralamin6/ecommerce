<?php

    namespace App\Policies;

    use App\Models\User;
    use App\Models\Banners;
    use Illuminate\Auth\Access\HandlesAuthorization;

    class BannersPolicy
    {
        use HandlesAuthorization;

        /**
         * Determine whether the banners can view any models.
         *
         * @param App\Models\User $user
         *
         * @return mixed
         */
        public function viewAny(User $user)
        {
            return $user->hasPermissionTo('list allbanners');
        }

        /**
         * Determine whether the banners can view the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Banners $model
         *
         * @return mixed
         */
        public function view(User $user, Banners $model)
        {
            return $user->hasPermissionTo('view allbanners');
        }

        /**
         * Determine whether the banners can create models.
         *
         * @param App\Models\User $user
         *
         * @return mixed
         */
        public function create(User $user)
        {
            return $user->hasPermissionTo('create allbanners');
        }

        /**
         * Determine whether the banners can update the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Banners $model
         *
         * @return mixed
         */
        public function update(User $user, Banners $model)
        {
            return $user->hasPermissionTo('update allbanners');
        }

        /**
         * Determine whether the banners can delete the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Banners $model
         *
         * @return mixed
         */
        public function delete(User $user, Banners $model)
        {
            return $user->hasPermissionTo('delete allbanners');
        }

        /**
         * Determine whether the user can delete multiple instances of the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Banners $model
         *
         * @return mixed
         */
        public function deleteAny(User $user)
        {
            return $user->hasPermissionTo('delete allbanners');
        }

        /**
         * Determine whether the banners can restore the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Banners $model
         *
         * @return mixed
         */
        public function restore(User $user, Banners $model)
        {
            return false;
        }

        /**
         * Determine whether the banners can permanently delete the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Banners $model
         *
         * @return mixed
         */
        public function forceDelete(User $user, Banners $model)
        {
            return false;
        }
    }
