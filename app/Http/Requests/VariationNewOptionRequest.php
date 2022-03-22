<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VariationNewOptionRequest extends FormRequest
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
            'productNewOption.*.new_option_name.*' => 'max:100|required',
            'productNewOption.*.new_option_sku.*' => 'nullable|max:16|unique:variation_options,sku',
            'productNewOption.*.new_option_price.*' => 'numeric|nullable',
            'productNewOption.*.new_option_quantity.*' => 'integer|nullable',
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
            'productNewOption.*.new_option_name.*' => 'option name',
            'productNewOption.*.new_option_sku.*' => 'option sku',
            'productNewOption.*.new_option_price.*' => 'option price',
            'productNewOption.*.new_option_quantity.*' => 'option quantity',
        ];
    }
}
