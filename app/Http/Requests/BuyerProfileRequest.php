<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BuyerProfileRequest extends FormRequest
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
            'zipcode' => 'nullable|max:12',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'state' => 'required|string|max:100',

            'billing_address_line_one' => 'required|string|max:255',
            'billing_address_line_two' => 'nullable|string|max:255',
            'billing_zipcode' => 'nullable|max:12',
            'billing_city' => 'required|string|max:100',
            'billing_district' => 'required|string|max:100',
            'billing_state' => 'required|string|max:100',
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
            'first_name' => 'first name',
            'last_name' => 'last name',
            'billing_country' => 'billing country',
            'billing_address' =>  'billing address',
            'billing_apt_no' => 'billing apt. number',
            'billing_zipcode' => 'billing zip code',
            'billing_city' => 'billing city',
            'billing_state' => 'billing state',
            'user_id' => 'user',
        ];
    }
}
