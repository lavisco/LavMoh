<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'total' => 'numeric|required',
            'subtotal' => 'numeric|required',
            'tax' => 'numeric|required',
            'giftwrap_price' => 'numeric|nullable',
            'shipping_price' => 'numeric|required',
            'discount_price' => 'numeric|nullable',
            'discount_code' => 'string|nullable',
        ];
    }
}
