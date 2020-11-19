<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Product extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => [
                'required'
            ],
            'price_cents' => [
                'required',
                'numeric',
                'min:0'
            ],
            'price_cents_promotion' => [
                'numeric',
                'min:0',
                'nullable',
                'lt:price_cents'
            ],
            'provider' => [
                'required'
            ],
            'bar_code' => [
                'required'
            ]
        ];
        // if method is not post set bar_code as unique
        if (strtoupper(request()->method()) != 'POST') {
            $rules['bar_code'][] = Rule::unique('products')->ignore($this->product->id, 'id');
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
            'name.required' => __("product_name_required"),
            'price_cents.required' => __("product_price_cents_numeric"),
            'price_cents.numeric' => __("product_price_cents_numeric"),
            'price_cents.min' => __("product_price_cents_numeric"),
            'price_cents_promotion.numeric' => __("product_price_cents_promotion_numeric"),
            'price_cents_promotion.min' => __("product_price_cents_promotion_numeric"),
            'price_cents_promotion.lt' => __("product_price_cents_promotion_numeric"),
            'provider.required' => __("provider_required"),
            'bar_code.unique' => __("product_bar_code_unique"),
            'bar_code.required' => __("product_bar_code_unique")
        ];
    }
}
