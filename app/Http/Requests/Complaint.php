<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Complaint extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'complaint' => [
                'required'
            ],
            'client_id' => [
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
            'complaint.required' => __("complaint_complaint_required"),
            'client_id.required' => __("complaint_client_id_required"),
        ];
    }
}
