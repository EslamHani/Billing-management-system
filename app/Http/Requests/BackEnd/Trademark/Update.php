<?php

namespace App\Http\Requests\BackEnd\Trademark;

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
            'name' => ['required', 'string' ,'max:250', 'unique:trademarks,name,'.$this->trademark],
            'logo' => ['nullable', 'image', 'max:10240', 'mimes:jpg,png,jpeg,gif'], // 10G
        ];
    }
}
