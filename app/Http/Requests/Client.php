<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Client extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'preferential' => [
                'boolean',
                'required'
            ],
            'name' => [
                'required'
            ],
            'email' => [
                'email',
                'required',
            ],
            'cpf' => [
                'required',
            ],
            'identity' => [
                'required',
            ],
            'address' => [
                'required'
            ]
        ];
        // if method is not post set bar_code as unique ignoring current product
        if (strtoupper(request()->method()) != 'POST') {
            $rules['email'][] = Rule::unique('clients')->ignore($this->client->id, 'id');
            $rules['cpf'][] = Rule::unique('clients')->ignore($this->client->id, 'id');
            $rules['identity'][] = Rule::unique('clients')->ignore($this->client->id, 'id');
        } else {
            $rules['email'][] = Rule::unique('clients');
            $rules['cpf'][] = Rule::unique('clients');
            $rules['identity'][] = Rule::unique('clients');
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
            'preferential.required' => __("client_preferential_required"),
            'preferential.boolean' => __("client_preferential_required"),
            'name.required' => __("client_name_required"),
            'email.required' => __("client_email_required"),
            'email.email' => __("client_email_required"),
            'email.unique' => __("client_email_required"),
            'cpf.required' => __("client_cpf_required"),
            'cpf.unique' => __("client_cpf_required"),
            'identity.required' => __("client_identity_required"),
            'identity.unique' => __("client_identity_required"),
            'address.required' => __("client_address_required"),
        ];
    }
}
