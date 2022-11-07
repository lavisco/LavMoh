<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductSellerRequest extends FormRequest
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
            'sku' => [
                'nullable',
                'max:16',
                Rule::unique('products')->ignore($this->id),
            ],
            'code' => 'nullable',
            'title' => 'max:255|required',
            'short_description' => 'max:500|required',
            'description' => 'max:2000|required',
            'length' => 'numeric|nullable',
            'width' => 'numeric|nullable',
            'height' => 'numeric|nullable',
            'dimensions_unit' => 'max:5|nullable',
            'weight' => 'numeric|nullable',
            'weight_unit' => 'max:5|required_with:weight',
            'base_price' => 'numeric|required',
            'processing_time' => 'max:20|required',
            'has_custom_text' => 'boolean|required',
            'has_custom_image' => 'boolean|required',
            'has_variations' => 'boolean|required',
            'has_inventory' => 'boolean|required',
            'has_giftwrap' => 'boolean|required',
            'quantity' => 'integer|required',
            'rating' => 'integer|nullable',
            'category_id' => 'required|sometimes',
            'product_sub_category' => 'required',

            //variations
            'productVariation.*.variation_description' => 'max:100|nullable',
            'productVariation.*.option_name.*' => 'required|sometimes',
            'productVariation.*.option_quantity.*' => 'integer|nullable',
            'productVariation.*.option_price.*' => 'numeric|required',
            'productVariation.*.option_sku.*' => [
                'nullable',
                'max:16',
                'unique:variation_options,sku',
            ],
            
            //images
            'image_path_primary' => 'required',
            'image_path.0' => 'required',
            'image_path.1' => 'required',
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
            'short_description' => 'short description',
            'dimensions_unit' => 'dimension unit',
            'weight_unit' =>  'weight unit',
            'base_price' => 'base price',
            'processing_time' => 'processing time',
            'has_custom_text' => 'enabling or disabling custom text',
            'has_custom_image' => 'enabling or disabling custom image',
            'has_variations' => 'enabling or disabling variations',
            'has_inventory' => 'enabling or disabling inventory',
            'has_giftwrap' => 'enabling or disabling giftwrap',
            'category_id' => 'category',

            //variations
            'productVariation.*.variation_description' => 'variation description',
            'productVariation.*.option_name.*' => 'variation option name',
            'productVariation.*.option_price.*' => 'variation option price',
            'productVariation.*.option_quantity.*' => 'variation option quantity',
            'productVariation.*.option_sku.*' => 'variation option sku',

            //images
            'image_path_primary' => 'primary image',
            'image_path.0' => 'second image',
            'image_path.1' => 'third image',
        ];
    }
}
