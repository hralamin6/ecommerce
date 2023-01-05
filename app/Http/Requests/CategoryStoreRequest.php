<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class CategoryStoreRequest extends FormRequest
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
                'name'        => ['required', 'max:255', 'string'],
                'category_id' => ['nullable', 'exists:categories,id'],
                'banner'      => ['nullable', 'image', 'max:1024'],
                'image'       => ['nullable', 'image', 'max:1024'],
                'status'      => ['nullable', 'boolean'],
                'slug'        => ['nullable', 'unique:categories', 'max:255', 'string'],
            ];
        }
    }
