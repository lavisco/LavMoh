<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|max:20',

            'address_line_one' => 'required|string|max:255',
            'address_line_two' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'zipcode' => 'nullable|max:12',
            'district' => 'required|string|max:100',
            'state' => 'required|string|max:100',

            'recipient_first_name' => 'required|string|max:100',
            'recipient_last_name' => 'required|string|max:100',
            'recipient_email' => 'nullable|string|email|max:255',
            'recipient_phone' => 'required|max:20',

            'billing_address_line_one' => 'required|string|max:255',
            'billing_address_line_two' => 'nullable|string|max:255',
            'billing_city' => 'required|string|max:100',
            'billing_zipcode' => 'nullable|max:12',
            'billing_district' => 'required|string|max:100',
            'billing_state' => 'nullable|string|max:100',

            'delivery_date' => 'date|required',
            'currency_code' => 'string|required|max:5',
            'current_exchange_rate' => 'numeric|required',

            'shipping_id' => 'required',
            'total' => 'numeric|required',
            'subtotal' => 'numeric|required',
            'giftwrap_price' => 'numeric|nullable',
            'shipping_price' => 'numeric|required',
            'discount_price' => 'numeric|nullable',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'billing_address_line_one' => 'billing address line 1',
            'billing_address_line_two' => 'billing address line 2',
            'billing_city' => 'billing city',
            'billing_zipcode' => 'billing zipcode',
            'billing_district' => 'billing district',
            'billing_state' => 'billing state',
            'delivery_date' => 'delivery date',
            'shipping_id' => 'shipping method',
            'giftwrap_price' => 'giftwrap price',
            'shipping_price' => 'shipping price',
            'discount_price' => 'discount price',
        ];
    }
}
