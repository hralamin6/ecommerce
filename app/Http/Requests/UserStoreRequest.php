<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class UserStoreRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            return [
                'avatar'    => ['nullable', 'image', 'max:1024'],
                'name'      => ['required', 'max:255', 'string'],
                'username'  => ['nullable', 'unique:users', 'max:255', 'string'],
                'email'     => ['required', 'unique:users', 'email'],
                'phone'     => ['nullable', 'max:255', 'string'],
                'password'  => ['required'],
                'user_type' => ['nullable', 'in:regular,premium'],
                'Shipping'  => ['nullable', 'string'],
                'roles'     => 'array',
            ];
        }
    }
