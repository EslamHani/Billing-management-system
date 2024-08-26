<?php

namespace App\Http\Requests\BackEnd\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


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
            'order_number' => ['required', 'string'],
            'client_name' => ['required', 'string'],
            'client_number1' => ['required', 'max:11', 'min:11'],
            'client_number2' => ['required', 'min:11', 'max:11'],
            'client_address' => ['required', 'string'],
            'client_username' => ['required', 'string'],
            'seller_name' => ['required', 'string'],
            'shipping' => ['required'],
            'governorate_id' => ['required', 'exists:governorates,id'],
            'note' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['approved', 'pendding', 'refused'])],
            'plateform' => ['required', Rule::in(['facebook', 'whatsapp', 'instagram', 'olx'])],
        ];
    }
}
