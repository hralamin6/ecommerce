<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class WorkStoreRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize(): bool
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules(): array
        {
            return [
                'url'      => ['nullable', 'url'],
                'type'     => ['nullable', 'in:video,image'],
                'file'     => ['nullable'],
                'notes'    => ['nullable', 'max:255', 'string'],
                'duration' => ['nullable', 'integer'],
                'price'    => ['nullable', 'integer'],
                'status'   => ['required', 'boolean'],
            ];
        }
    }
