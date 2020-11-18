<?php

namespace App\Http\Requests;


class UserRegister extends CheckIfIsManager
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ["email" => ["email", "required"], "name" => ["required"]];
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
            'name.required' => __("user_name_required")
        ];
    }
}
