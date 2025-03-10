<?php

    namespace App\Policies;

    use App\Models\User;
    use App\Models\Transection;
    use Illuminate\Auth\Access\HandlesAuthorization;

    class TransectionPolicy
    {
        use HandlesAuthorization;

        /**
         * Determine whether the transection can view any models.
         *
         * @param App\Models\User $user
         *
         * @return mixed
         */
        public function viewAny(User $user)
        {
            return true;
        }

        /**
         * Determine whether the transection can view the model.
         *
         * @param App\Models\User        $user
         * @param App\Models\Transection $model
         *
         * @return mixed
         */
        public function view(User $user, Transection $model)
        {
            return true;
        }

        /**
         * Determine whether the transection can create models.
         *
         * @param App\Models\User $user
         *
         * @return mixed
         */
        public function create(User $user)
        {
            return true;
        }

        /**
         * Determine whether the transection can update the model.
         *
         * @param App\Models\User        $user
         * @param App\Models\Transection $model
         *
         * @return mixed
         */
        public function update(User $user, Transection $model)
        {
            return true;
        }

        /**
         * Determine whether the transection can delete the model.
         *
         * @param App\Models\User        $user
         * @param App\Models\Transection $model
         *
         * @return mixed
         */
        public function delete(User $user, Transection $model)
        {
            return true;
        }

        /**
         * Determine whether the user can delete multiple instances of the model.
         *
         * @param App\Models\User        $user
         * @param App\Models\Transection $model
         *
         * @return mixed
         */
        public function deleteAny(User $user)
        {
            return true;
        }

        /**
         * Determine whether the transection can restore the model.
         *
         * @param App\Models\User        $user
         * @param App\Models\Transection $model
         *
         * @return mixed
         */
        public function restore(User $user, Transection $model)
        {
            return false;
        }

        /**
         * Determine whether the transection can permanently delete the model.
         *
         * @param App\Models\User        $user
         * @param App\Models\Transection $model
         *
         * @return mixed
         */
        public function forceDelete(User $user, Transection $model)
        {
            return false;
        }
    }
