<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class OrdersUpdateRequest extends FormRequest
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
                'user_id' => ['nullable', 'exists:users,id'],
                'code'    => ['string'],
                //            'shipping_address' => ['required', 'string'],
                //            'delivery_status' => [
                //                'required',
                //                'in:ordered,accepted,processing,delivered,canceled',
                //            ],
                //            'payment_type' => ['required', 'in:cash on delivery,ssl commerce'],
                //            'payment_status' => ['required', 'in:unpaid,paid'],
                //            'grand_total' => ['required', 'numeric'],
                //            'coupon_discount' => ['required', 'numeric'],
                //            'shipping_cost' => ['required', 'numeric'],
                //            'shipping_district' => ['required', 'string'],
            ];
        }
    }
