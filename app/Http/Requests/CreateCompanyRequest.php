<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
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
            'domain'=>'bail|required|string|max:10|unique:companies',
            'name'=>'bail|required|string',
            'email' => 'bail|required|unique:companies|string|email',
            'password' => 'bail|required|string',
            'url' => 'bail|required|string',
            'logo_path' => 'nullable|file'
        ];
    }
}
