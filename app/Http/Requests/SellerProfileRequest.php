<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SellerProfileRequest extends FormRequest
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
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'phone' => 'required|digits_between:5,20',
            'country' => 'required|max:80',
            'address' => 'required|max:255',
            'apt_no' => 'max:20|nullable',
            'zipcode' => 'max:12|nullable',
            'city' => 'required|max:100',
            'state' => 'max:100|nullable',
            'billing_country' => 'required|max:80',
            'billing_address' => 'required|max:255',
            'billing_apt_no' => 'max:20|nullable',
            'billing_zipcode' => 'max:12|nullable',
            'billing_city' => 'required|max:100',
            'billing_state' => 'max:100|nullable',
            'deposit_account' => 'required|max:34',
            'deposit_name' => 'required',
            'deposit_bank' => 'required',
            'deposit_bank_branch' => 'required',
            'deposit_account_status' => 'required|boolean',
            'user_id' => [
                'required',
                'sometimes',
                Rule::unique('seller_profiles')->ignore($this->id),
            ],
        ];
    }
}
