<?php

    namespace App\Policies;

    use App\Models\User;
    use App\Models\Slider;
    use Illuminate\Auth\Access\HandlesAuthorization;

    class SliderPolicy
    {
        use HandlesAuthorization;

        /**
         * Determine whether the slider can view any models.
         *
         * @param App\Models\User $user
         *
         * @return mixed
         */
        public function viewAny(User $user)
        {
            return $user->hasPermissionTo('list sliders');
        }

        /**
         * Determine whether the slider can view the model.
         *
         * @param App\Models\User   $user
         * @param App\Models\Slider $model
         *
         * @return mixed
         */
        public function view(User $user, Slider $model)
        {
            return $user->hasPermissionTo('view sliders');
        }

        /**
         * Determine whether the slider can create models.
         *
         * @param App\Models\User $user
         *
         * @return mixed
         */
        public function create(User $user)
        {
            return $user->hasPermissionTo('create sliders');
        }

        /**
         * Determine whether the slider can update the model.
         *
         * @param App\Models\User   $user
         * @param App\Models\Slider $model
         *
         * @return mixed
         */
        public function update(User $user, Slider $model)
        {
            return $user->hasPermissionTo('update sliders');
        }

        /**
         * Determine whether the slider can delete the model.
         *
         * @param App\Models\User   $user
         * @param App\Models\Slider $model
         *
         * @return mixed
         */
        public function delete(User $user, Slider $model)
        {
            return $user->hasPermissionTo('delete sliders');
        }

        /**
         * Determine whether the user can delete multiple instances of the model.
         *
         * @param App\Models\User   $user
         * @param App\Models\Slider $model
         *
         * @return mixed
         */
        public function deleteAny(User $user)
        {
            return $user->hasPermissionTo('delete sliders');
        }

        /**
         * Determine whether the slider can restore the model.
         *
         * @param App\Models\User   $user
         * @param App\Models\Slider $model
         *
         * @return mixed
         */
        public function restore(User $user, Slider $model)
        {
            return false;
        }

        /**
         * Determine whether the slider can permanently delete the model.
         *
         * @param App\Models\User   $user
         * @param App\Models\Slider $model
         *
         * @return mixed
         */
        public function forceDelete(User $user, Slider $model)
        {
            return false;
        }
    }
