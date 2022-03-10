<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariationStoreRequest extends FormRequest
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
            'productVariation.*.sku.*' => 'nullable|max:16|unique:product_variations,sku',
            'productVariation.*.variationDescription' => 'max:100|nullable',
            'productVariation.*.variation_type_option.*' => 'required|sometimes',
            'productVariation.*.variation_quantity.*' => 'integer|nullable',
            'productVariation.*.variation_price.*' => 'numeric|required',
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
            'productVariation.*.sku.*' => 'variation sku',
            'productVariation.*.variationDescription' => 'variation description',
            'productVariation.*.variation_price.*' => 'variation price',
            'productVariation.*.variation_quantity.*' => 'variation quantity',
            'productVariation.*.variation_type_option.*' => 'variation type option',
        ];
    }
}
