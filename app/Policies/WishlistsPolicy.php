<?php

    namespace App\Policies;

    use App\Models\User;
    use App\Models\Wishlists;
    use Illuminate\Auth\Access\HandlesAuthorization;

    class WishlistsPolicy
    {
        use HandlesAuthorization;

        /**
         * Determine whether the wishlists can view any models.
         *
         * @param App\Models\User $user
         *
         * @return mixed
         */
        public function viewAny(User $user)
        {
            return $user->hasPermissionTo('list allwishlists');
        }

        /**
         * Determine whether the wishlists can view the model.
         *
         * @param App\Models\User      $user
         * @param App\Models\Wishlists $model
         *
         * @return mixed
         */
        public function view(User $user, Wishlists $model)
        {
            return $user->hasPermissionTo('view allwishlists');
        }

        /**
         * Determine whether the wishlists can create models.
         *
         * @param App\Models\User $user
         *
         * @return mixed
         */
        public function create(User $user)
        {
            return $user->hasPermissionTo('create allwishlists');
        }

        /**
         * Determine whether the wishlists can update the model.
         *
         * @param App\Models\User      $user
         * @param App\Models\Wishlists $model
         *
         * @return mixed
         */
        public function update(User $user, Wishlists $model)
        {
            return $user->hasPermissionTo('update allwishlists');
        }

        /**
         * Determine whether the wishlists can delete the model.
         *
         * @param App\Models\User      $user
         * @param App\Models\Wishlists $model
         *
         * @return mixed
         */
        public function delete(User $user, Wishlists $model)
        {
            return $user->hasPermissionTo('delete allwishlists');
        }

        /**
         * Determine whether the user can delete multiple instances of the model.
         *
         * @param App\Models\User      $user
         * @param App\Models\Wishlists $model
         *
         * @return mixed
         */
        public function deleteAny(User $user)
        {
            return $user->hasPermissionTo('delete allwishlists');
        }

        /**
         * Determine whether the wishlists can restore the model.
         *
         * @param App\Models\User      $user
         * @param App\Models\Wishlists $model
         *
         * @return mixed
         */
        public function restore(User $user, Wishlists $model)
        {
            return false;
        }

        /**
         * Determine whether the wishlists can permanently delete the model.
         *
         * @param App\Models\User      $user
         * @param App\Models\Wishlists $model
         *
         * @return mixed
         */
        public function forceDelete(User $user, Wishlists $model)
        {
            return false;
        }
    }
