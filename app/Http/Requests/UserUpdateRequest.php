<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize ()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ()
    {
        return [
            'avatar'    => [ 'nullable', 'image', 'max:1024' ],
            'name'      => [ 'required', 'max:255', 'string' ],
            'username'  => [
                'nullable',
                Rule::unique ('users')->ignore ($this->user->id, 'id'),
                'max:255',
                'string',
            ],
            'email'     => [
                'required',
                Rule::unique ('users')->ignore ($this->user->id, 'id'),
                'email',
            ],
            'phone'     => [ 'nullable', 'max:255', 'string' ],
            'user_type' => [ 'nullable', 'in:regular,premium,admin' ],
            'shipping'  => [ 'nullable', 'string' ],
            'password'  => [ 'nullable' ]
        ];
    }
}
