<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'search'=>[
                'bail',
                'required',
                'max:10',
                function ($attribute, $value, $fail) {
                    if(strtoupper($value) !== $value) {
                        return $fail("The $attribute must be upper case");
                    }
                }
            ],
            'type'=>[
                'bail',
                'required',
                'max:5'
            ],
        ];
    }
}
