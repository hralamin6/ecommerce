<?php

    namespace App\Rules;

    use App\Models\User;
    use Illuminate\Contracts\Validation\Rule;

    class isBlocked implements Rule
    {
        /**
         * Create a new rule instance.
         *
         * @return void
         */
        public function __construct()
        {
            //
        }

        /**
         * Determine if the validation rule passes.
         *
         * @param string $attribute
         * @param mixed  $value
         *
         * @return bool
         */
        public function passes($attribute, $value): bool
        {
            $user = User::whereUsername($value)->first ();
            return $user != null && !$user->is_blocked;
        }

        /**
         * Get the validation error message.
         *
         * @return string
         */
        public function message(): string
        {
            return __('crud.common.block_notice');
        }
    }
