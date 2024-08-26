<?php

namespace App\Http\Requests\BackEnd\Trademark;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'name' => ['required', 'string' ,'max:250', 'unique:trademarks'],
            'logo' => ['nullable', 'image', 'max:10240', 'mimes:jpg,png,jpeg,gif'], // 10G
        ];
    }
}
