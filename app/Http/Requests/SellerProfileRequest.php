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
            'email' => 'required|email',
            'country' => 'required|max:80',
            'province' => 'required',
            'district' => 'required',
            'city' => 'required',
            'address' => 'required|max:255',
            'zipcode' => 'max:12|nullable',
            'billing_address' => 'required|max:255',
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
            'deposit_account' => 'deposit account no.',
            'deposit_name' => 'deposit account name',
            'deposit_bank' => 'deposit bank name',
            'deposit_bank_branch' => 'deposit bank branch name',
            'deposit_account_status' => 'deposit bank account status',
            'user_id' => 'user',
        ];
    }
}
