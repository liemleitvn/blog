<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:roles'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Role name cannot be empty. Please entry the role before click button add',
            'name.unique'=>'Role is already exist. Please check and try again'
        ];
    }
}
