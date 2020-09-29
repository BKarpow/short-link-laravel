<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigsRequest extends FormRequest
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
            'namespace' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'namespace.required' => 'Namespace обов\'язкове',
//            'namespace.unique' => 'Namespace має бути унікальним'
        ];
    }
}
