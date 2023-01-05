<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class CouponsUpdateRequest extends FormRequest
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
                'code'          => ['required', 'max:255', 'string'],
                'discount'      => ['required', 'numeric'],
                'discount_type' => ['required', 'in:percent,amount'],
                'start'         => ['required', 'date', 'date'],
                'end'           => ['required', 'date', 'date'],
            ];
        }
    }
