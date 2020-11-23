<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Client extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'preferential' => [
                'boolean',
                'required'
            ],
            'name' => [
                'required'
            ],
            'email' => [
                'email',
                'required'
            ],
            'cpf' => [
                'required'
            ],
            'identity' => [
                'required'
            ],
            'address' => [
                'required'
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
            'preferential.required' => __("client_preferential_required"),
            'preferential.boolean' => __("client_preferential_required"),
            'name.required' => __("client_name_required"),
            'email.required' => __("client_email_required"),
            'email.email' => __("client_email_required"),
            'cpf.required' => __("client_cpf_required"),
            'identity.required' => __("client_identity_required"),
            'address.required' => __("client_address_required"),
        ];
    }
}
