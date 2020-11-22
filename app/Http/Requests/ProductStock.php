<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStock extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => [
                'required'
            ],
            'input' => [
                'numeric',
                'nullable',
                'min:1'
            ],
            'output' => [
                'numeric',
                'nullable',
                'min:1'
            ]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'product_id' => __("product_stock_product_id"),
            'input.min' => __("product_stock_input"),
            'output' => __("product_stock_output"),
        ];
    }
}
