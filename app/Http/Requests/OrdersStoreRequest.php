<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class OrdersStoreRequest extends FormRequest
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
                'user_id'           => ['required', 'exists:users,id'],
                'code'              => ['unique:orders', 'string'],
                'shipping_address'  => ['required', 'string'],
                'delivery_status'   => [
                    'in:ordered,accepted,processing,delivered,canceled',
                ],
                'payment_type'      => ['required', 'in:cash on delivery,ssl commerce'],
                'payment_status'    => ['in:unpaid,paid'],
                'grand_total'       => ['numeric'],
                'coupon_discount'   => ['numeric'],
                'commission'        => ['numeric'],
                'shipping_cost'     => ['numeric'],
                'shipping_district' => ['required', 'string'],
                'viewed'            => ['boolean'],
            ];
        }
    }
