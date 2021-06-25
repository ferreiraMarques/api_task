<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTask extends FormRequest
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
            'name' => 'required|max:60',
            'completed' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'field name is required',
            'name.max' => 'name maxlength is the 60 characters',
            'complete.required' => 'field complete is required',
            'complete.boolean' => 'complete is type boolean',
        ];
    }
}
