<?php

namespace App\Http\Requests\BackEnd\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,'.$this->user],
            'password' => ['nullable', 'string', 'min:8', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'],
            'image'   => ['nullable', 'image', 'max:10240', 'mimes:jpg,png,jpeg,gif'],
            'roles'     => ['required', 'exists:roles,id'],
            'status'    => ['required', Rule::in(['active', 'unactive'])]
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'The password must be more 6 or more characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character ($#^%_).'
        ];
    }
}
