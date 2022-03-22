<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VariationAndOptionStoreRequest extends FormRequest
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
            'productVariation.*.new_variation_description' => 'max:100|nullable',
            'productVariation.*.new_variation_option_name.*' => 'required|sometimes',
            'productVariation.*.new_variation_option_quantity.*' => 'integer|nullable',
            'productVariation.*.new_variation_option_price.*' => 'numeric|required',
            'productVariation.*.new_variation_option_sku.*' => 'nullable|max:16|unique:variation_options,sku',
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
            'productVariation.*.new_variation_description' => 'variation description',
            'productVariation.*.new_variation_option_name.*' => 'option name',
            'productVariation.*.new_variation_option_sku.*' => 'option sku',
            'productVariation.*.new_variation_option_price.*' => 'option price',
            'productVariation.*.new_variation_option_quantity.*' => 'option quantity',
        ];
    }
}
