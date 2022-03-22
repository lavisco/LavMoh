<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VariationOptionRequest extends FormRequest
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
            'option_name.*' => 'max:100|required',
            //'option_sku.*' => 'max:16|nullable',
            'option_price.*' => 'numeric|nullable',
            'option_quantity.*' => 'integer|nullable',
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
            'option_name.*' => 'option name',
            'option_sku.*' => 'option sku',
            'option_price.*' => 'option price',
            'option_quantity.*' => 'option quantity',
        ];
    }
}
