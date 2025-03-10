<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class BrandStoreRequest extends FormRequest
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
                'name'   => ['required', 'max:255', 'string'],
                'slug'   => ['unique:brands', 'string'],
                'logo'   => ['required', 'image'],
                'status' => ['required', 'boolean'],
            ];
        }
    }
