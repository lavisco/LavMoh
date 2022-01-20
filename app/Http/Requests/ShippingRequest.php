<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShippingRequest extends FormRequest
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
            'type' => [
                'required',
                'max:100',
                Rule::unique('shippings')->ignore($this->id),
            ],
            'price' => 'numeric|required',
            'delivery_time' => 'max:20|required',
            'locations' => 'nullable',
            'tracking_opt' => 'nullable',
        ];
    }
}
