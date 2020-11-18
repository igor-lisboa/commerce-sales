<?php

namespace App\Http\Requests;

use App\Models\Manager as ModelsManager;
use Illuminate\Foundation\Http\FormRequest;

class Manager extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (ModelsManager::count() == 0 || auth()->user()->manager != null);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'user_id' => [
                'unique:managers'
            ]
        ];
        // if method is post set user_id as required
        if (strtoupper(request()->method()) == 'POST') {
            $rules['user_id'][] = 'required';
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
            'user_id.required' => __("manager_user_id_required"),
            'user_id.unique' => __("manager_user_id_unique"),
        ];
    }
}
