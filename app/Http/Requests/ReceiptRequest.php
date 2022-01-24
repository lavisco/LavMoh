<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptRequest extends FormRequest
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
            'was_paid' => 'boolean|required',
            'was_claimed' => 'boolean|required',
            'status' => 'required',
            'name' => 'max:100|required',
            'country' => 'max:80|required',
            'address' => 'max:255|required',
            'apt_no' => 'max:20|nullable',
            'zipcode' => 'max:12|nullable',
            'city' => 'max:100|required',
            'state' => 'max:100|nullable',
            'payment_method' => 'required',
            'payment_email' => 'required',
            'has_giftwrap' => 'boolean|required',
            'total' => 'numeric|required',
            'subtotal' => 'numeric|required',
            'tax' => 'numeric|required',
            'giftwrap_price' => 'numeric|nullable|required_with:has_giftwrap',
            'shipping_price' => 'numeric|required',
            'discount_price' => 'numeric|nullable',
        ];
    }
}
