<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleSetPaymentMethod extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_method_id' => [
                'required'
            ],
            'used_points' => [
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
            'payment_method_id.required' => __("sale_msg_payment_method_id"),
            'used_points.min' => __("sale_msg_used_points"),
        ];
    }
}
