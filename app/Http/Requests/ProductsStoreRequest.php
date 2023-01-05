<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsStoreRequest extends FormRequest
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
            'category_id'    => [ 'required', 'exists:categories,id' ],
            'name'           => [ 'required', 'max:255', 'string' ],
            'description'    => [ 'required' ],
            'point'          => [ 'required' ],
            'sale_price'     => [ 'required', 'numeric' ],
            'purchase_price' => [ 'required', 'numeric' ],
            'gallery'        => [ 'nullable' ],
            'thumbnail_img'  => [ 'required', 'image', 'max:1024' ],
            'status'         => [ 'nullable', 'boolean' ],
            'is_flash'       => [ 'nullable', 'boolean' ],
            'is_feature'     => [ 'nullable', 'boolean' ],
            'discount'       => [ 'nullable', 'numeric' ],
            'discount_type'  => [ 'nullable', 'in:percentage,amount' ],
            'stock'          => [ 'required', 'max:255' ],
            'colors'         => [ 'nullable' ],
            'sizes'          => [ 'nullable', 'string' ],
            'is_variant'     => [ 'nullable', 'boolean' ]
        ];
    }
}
