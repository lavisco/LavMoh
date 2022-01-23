<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SellerRegisterRequest extends FormRequest
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
            //user
            'name' => 'sometimes|required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->id),
            ],
            'password' => 'sometimes|required|string|min:8',
            //'avatar' => 'nullable',

            //seller profile
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

            //shop
            'name' => 'required|max:400',
            'banner' => 'nullable',
            'about' => 'required',
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
