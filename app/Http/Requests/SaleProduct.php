<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleProduct extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'quantity' => [
                'required',
                'numeric',
                'min:1'
            ],
        ];
        if (strtoupper(request()->method()) == 'POST') {
            $rules['product_id'] = [
                'required'
            ];
        }
        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'product_id.required' => __("sale_product_msg_product_id_required"),
            'quantity.required' => __("sale_product_msg_quantity_required"),
            'quantity.numeric' => __("sale_product_msg_quantity_required"),
            'quantity.min' => __("sale_product_msg_quantity_required"),
        ];
    }
}
