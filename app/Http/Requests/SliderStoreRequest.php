<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class SliderStoreRequest extends FormRequest
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
         * Get the error messages for the defined validation rules.
         *
         * @return array
         */
        public function messages()
        {
            return [
                'image.max' => 'Slider size should be under 1MB',
            ];
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            return [
                'title'    => ['nullable', 'max:100', 'string'],
                'subtitle' => ['nullable', 'max:100', 'string'],
                'action'   => ['nullable', 'url'],
                'image'    => ['required', 'image', 'max:1024'],
                'status'   => ['nullable', 'boolean'],
            ];
        }
    }
