<?php

    namespace App\Policies;

    use App\Models\User;
    use App\Models\OrderDetails;
    use Illuminate\Auth\Access\HandlesAuthorization;

    class OrderDetailsPolicy
    {
        use HandlesAuthorization;

        /**
         * Determine whether the orderDetails can view any models.
         *
         * @param App\Models\User $user
         *
         * @return mixed
         */
        public function viewAny(User $user)
        {
            return $user->hasPermissionTo('list allorderdetails');
        }

        /**
         * Determine whether the orderDetails can view the model.
         *
         * @param App\Models\User         $user
         * @param App\Models\OrderDetails $model
         *
         * @return mixed
         */
        public function view(User $user, OrderDetails $model)
        {
            return $user->hasPermissionTo('view allorderdetails');
        }

        /**
         * Determine whether the orderDetails can create models.
         *
         * @param App\Models\User $user
         *
         * @return mixed
         */
        public function create(User $user)
        {
            return $user->hasPermissionTo('create allorderdetails');
        }

        /**
         * Determine whether the orderDetails can update the model.
         *
         * @param App\Models\User         $user
         * @param App\Models\OrderDetails $model
         *
         * @return mixed
         */
        public function update(User $user, OrderDetails $model)
        {
            return $user->hasPermissionTo('update allorderdetails');
        }

        /**
         * Determine whether the orderDetails can delete the model.
         *
         * @param App\Models\User         $user
         * @param App\Models\OrderDetails $model
         *
         * @return mixed
         */
        public function delete(User $user, OrderDetails $model)
        {
            return $user->hasPermissionTo('delete allorderdetails');
        }

        /**
         * Determine whether the user can delete multiple instances of the model.
         *
         * @param App\Models\User         $user
         * @param App\Models\OrderDetails $model
         *
         * @return mixed
         */
        public function deleteAny(User $user)
        {
            return $user->hasPermissionTo('delete allorderdetails');
        }

        /**
         * Determine whether the orderDetails can restore the model.
         *
         * @param App\Models\User         $user
         * @param App\Models\OrderDetails $model
         *
         * @return mixed
         */
        public function restore(User $user, OrderDetails $model)
        {
            return false;
        }

        /**
         * Determine whether the orderDetails can permanently delete the model.
         *
         * @param App\Models\User         $user
         * @param App\Models\OrderDetails $model
         *
         * @return mixed
         */
        public function forceDelete(User $user, OrderDetails $model)
        {
            return false;
        }
    }
