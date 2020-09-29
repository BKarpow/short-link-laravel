<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigsNewRequest extends FormRequest
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
            'namespace' => 'required|max:249',
            'name' => 'required|max:249',
            'key' => 'required|max:249',
            'value' => 'required',
            'description' => 'required|max:1500',
        ];
    }
}
