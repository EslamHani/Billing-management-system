<?php

namespace App\Http\Requests\BackEnd\Department;

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
            'department_name' => ['required', 'string', 'min:2' ,'max:200', 'unique:departments,id,'.$this->department],
            'description'     => ['nullable', 'string', 'max:250'],
        ];
    }

    public function attributes()
    {
        return [
            'department_name' => 'اسم القسم',
            'description'     => 'الوصف',
        ];
    }

    public function messages()
    {
        return [
            'department_name.unique' => 'هذا القسم موجود بالفعل ',
        ];
    }
}
