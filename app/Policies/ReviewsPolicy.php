<?php

    namespace App\Policies;

    use App\Models\User;
    use App\Models\Reviews;
    use Illuminate\Auth\Access\HandlesAuthorization;

    class ReviewsPolicy
    {
        use HandlesAuthorization;

        /**
         * Determine whether the reviews can view any models.
         *
         * @param App\Models\User $user
         *
         * @return mixed
         */
        public function viewAny(User $user)
        {
            return $user->hasPermissionTo('list allreviews');
        }

        /**
         * Determine whether the reviews can view the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Reviews $model
         *
         * @return mixed
         */
        public function view(User $user, Reviews $model)
        {
            return $user->hasPermissionTo('view allreviews');
        }

        /**
         * Determine whether the reviews can create models.
         *
         * @param App\Models\User $user
         *
         * @return mixed
         */
        public function create(User $user)
        {
            return $user->hasPermissionTo('create allreviews');
        }

        /**
         * Determine whether the reviews can update the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Reviews $model
         *
         * @return mixed
         */
        public function update(User $user, Reviews $model)
        {
            return $user->hasPermissionTo('update allreviews');
        }

        /**
         * Determine whether the reviews can delete the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Reviews $model
         *
         * @return mixed
         */
        public function delete(User $user, Reviews $model)
        {
            return $user->hasPermissionTo('delete allreviews');
        }

        /**
         * Determine whether the user can delete multiple instances of the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Reviews $model
         *
         * @return mixed
         */
        public function deleteAny(User $user)
        {
            return $user->hasPermissionTo('delete allreviews');
        }

        /**
         * Determine whether the reviews can restore the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Reviews $model
         *
         * @return mixed
         */
        public function restore(User $user, Reviews $model)
        {
            return false;
        }

        /**
         * Determine whether the reviews can permanently delete the model.
         *
         * @param App\Models\User    $user
         * @param App\Models\Reviews $model
         *
         * @return mixed
         */
        public function forceDelete(User $user, Reviews $model)
        {
            return false;
        }
    }
