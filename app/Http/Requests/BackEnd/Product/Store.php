<?php

namespace App\Http\Requests\BackEnd\Product;

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
            'product_name'  => ['required', 'string', 'max:200', 'unique:products'],
            'code'  => ['required', 'string', 'max:10', 'unique:products'],
            'photo'  => ['required', 'image', 'mimes:jpg,png,jpeg,gif', 'max:10240'],
            'description'  => ['required', 'string'],
            'colors'   => ['required', 'exists:colors,id'],
            'selling_price'  => ['required', 'numeric'],
            'Purchasing_price'  => ['required', 'numeric'],
            'stock'  => ['required', 'integer'],
            'dep_id'  => ['required', 'integer', 'exists:departments,id'],
            'trade_id'  => ['required', 'integer', 'exists:trademarks,id'],
        ];
    }

    public function attributes()
    {
        return [
            'product_name'     => trans('admin.product_name'),
            'code'             => trans('admin.code'),
            'photo'            => trans('admin.photo'),
            'description'      => trans('admin.description'),
            'selling_price'    => trans('admin.selling_price'),
            'Purchasing_price' => trans('admin.Purchasing_price'),
            'stock'            => trans('admin.stock'),
            'dep_id'           => trans('admin.dep_id'),
            'trade_id'         => trans('admin.trade_id'),
            'colors'           => trans('admin.colors'),
        ];
    }

    

}
