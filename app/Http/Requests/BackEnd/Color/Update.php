<?php

namespace App\Http\Requests\BackEnd\Color;

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
            'name'  => ['required', 'string', 'unique:colors,id,'.$this->color],
            'color' => ['required', 'string', 'unique:colors,id,'.$this->color],
        ];
    }

    public function attributes()
    {
        return [
            'name'  => trans('admin.name'),
            'color' => trans('admin.color'),
        ];
    }
}
