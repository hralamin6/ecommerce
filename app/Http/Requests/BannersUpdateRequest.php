<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class BannersUpdateRequest extends FormRequest
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
                'title'     => ['required', 'max:255', 'string'],
                'sub_title' => ['required', 'max:255', 'string'],
                'url'       => ['required', 'url'],
                'position'  => ['required', 'numeric'],
                'photo'     => ['nullable', 'image', 'max:1024'],
                'status'    => ['required', 'boolean'],
            ];
        }
    }
