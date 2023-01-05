<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class TransactionUpdateRequest extends FormRequest
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
                'user_id' => ['required', 'exists:users,id'],
                'work_id' => ['nullable', 'exists:works,id'],
                'amount'  => ['required', 'numeric'],
                'note'    => ['nullable', 'max:255', 'string'],
            ];
        }
    }
