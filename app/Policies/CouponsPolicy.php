<?php

    namespace App\Policies;

    use App\Models\User;
    use App\Models\Coupons;
    use Illuminate\Auth\Access\HandlesAuthorization;

    class CouponsPolicy
    {
        use HandlesAuthorization;

        /**
         * Determine whether the coupons can view any models.
         *
         * @param App\Models\User $user
         *
         * @return mixed
         */
        public function viewAny(User $user)
        {
            return $user->hasPermissionTo('list allcoupons');
        }

        /**
         * Determine whether the coupons can view the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Coupons $model
         *
         * @return mixed
         */
        public function view(User $user, Coupons $model)
        {
            return $user->hasPermissionTo('view allcoupons');
        }

        /**
         * Determine whether the coupons can create models.
         *
         * @param App\Models\User $user
         *
         * @return mixed
         */
        public function create(User $user)
        {
            return $user->hasPermissionTo('create allcoupons');
        }

        /**
         * Determine whether the coupons can update the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Coupons $model
         *
         * @return mixed
         */
        public function update(User $user, Coupons $model)
        {
            return $user->hasPermissionTo('update allcoupons');
        }

        /**
         * Determine whether the coupons can delete the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Coupons $model
         *
         * @return mixed
         */
        public function delete(User $user, Coupons $model)
        {
            return $user->hasPermissionTo('delete allcoupons');
        }

        /**
         * Determine whether the user can delete multiple instances of the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Coupons $model
         *
         * @return mixed
         */
        public function deleteAny(User $user)
        {
            return $user->hasPermissionTo('delete allcoupons');
        }

        /**
         * Determine whether the coupons can restore the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Coupons $model
         *
         * @return mixed
         */
        public function restore(User $user, Coupons $model)
        {
            return false;
        }

        /**
         * Determine whether the coupons can permanently delete the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Coupons $model
         *
         * @return mixed
         */
        public function forceDelete(User $user, Coupons $model)
        {
            return false;
        }
    }
