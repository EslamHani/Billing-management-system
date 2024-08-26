<?php

namespace App\Http\Requests\BackEnd\Shipping;

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
            'shipping' => ['required', 'integer'],
            'Urgent_shipping' => ['required', 'integer'],
            'governorate_id' => ['required', 'integer', 'exists:governorates,id', 'unique:shippings'],
        ];
    }
}
