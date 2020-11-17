<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegister extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ["email" => ["email", "required"], "password" => ["required"], "name" => ["required"]];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'E-Mail',
            'password' => 'Senha',
            'name' => 'Nome'
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
            'email.email' => __("user_email_email"),
            'email.required' => __("user_email_required"),
            'password.required' => __("user_password_required"),
            'name.required' => __("user_name_required")
        ];
    }
}
