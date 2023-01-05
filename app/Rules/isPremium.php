<?php

    namespace App\Rules;

    use App\Models\User;
    use Illuminate\Contracts\Validation\Rule;

    class isPremium implements Rule
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
            $user = User::query()->where('username', $value);
            return $user->exists() && ($user->first()->user_type == 'premium' || $user->first()->user_type == 'admin');
        }

        /**
         * Get the validation error message.
         *
         * @return string
         */
        public function message(): string
        {
            return 'Referral user must be premium';
        }
    }
