<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomProductInquiryRequest extends FormRequest
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
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email',
            'phone' => 'required|max:20',
            'address' => 'required|max:250',
            //'zipcode' => 'nullable|max:12',
            'city' => 'required|max:100',
            'district' => 'nullable|max:100',
            'state' => 'nullable|max:100',
            'description' => 'required|max:1000',
            'delivery_date' => 'required',
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
            'delivery_date' => 'delivery date',
        ];
    }
}
