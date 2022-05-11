<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'status' => 'max:50|required',
            'total_amount' => 'numeric|required',
            'bank_charge' => 'numeric|required',
            'platform_charge' => 'numeric|required',
            'shop_discount' => 'numeric|nullable',
            'payable_amount' => 'numeric|required',

            'cleared_by' => 'max:100|nullable',
            'payment_mode' => 'max:50|nullable',
            'clearance_date' => 'date|nullable',
            'request_withdrawal_date' => 'date|nullable',
        ];
    }
}
