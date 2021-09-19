<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeeditRequest extends FormRequest
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
            'name' => 'required|max:100',
            'text1' => 'required',
            'text2' => 'required',
            'tags' =>  'required|regex:/^#.*$/|max:100'
        ];
    }
}
