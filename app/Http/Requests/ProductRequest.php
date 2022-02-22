<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'description' => 'max:1000|required',
            'length' => 'numeric|nullable',
            'width' => 'numeric|nullable',
            'height' => 'numeric|nullable',
            'dimensions_unit' => 'max:5|required_with:length,width,height',
            'weight' => 'numeric|nullable',
            'weight_unit' => 'max:5|required_with:weight',
            'base_price' => 'numeric|nullable',
            'production_time' => 'max:20|nullable',
            'cut_off_time' => 'max:20|nullable',
            'processing_time' => 'max:20|required',
            'has_custom_text' => 'boolean|required',
            'has_custom_image' => 'boolean|required',
            'has_variations' => 'boolean|required',
            'has_inventory' => 'boolean|required',
            'quantity' => 'integer|required',
            'rating' => 'integer|nullable',
            'has_giftwrap' => 'boolean|required',
            //'product_state_id' => 'required|sometimes',
            'category_id' => 'required|sometimes',
            //'user_id' => 'required|sometimes',

            //product variation request validation
            'productVariation.*.sku.*' => [
                'nullable',
                'max:16',
                Rule::unique('product_variations')->ignore($this->id),
            ],
            'productVariation.*.var_option_id_array.*' => 'required|sometimes',
            'productVariation.*.var_quantity_array.*' => 'integer|nullable',
            'productVariation.*.var_price_array.*' => 'numeric|nullable',
            'productVariation.*.description.*' => 'max:500|nullable',
            'image_path.*' => 'required',
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
            'dimensions_unit' => 'dimension unit',
            'weight_unit' =>  'weight unit',
            'base_price' => 'base price',
            'production_time' => 'production time',
            'cut_off_time' => 'cut-off time',
            'processing_time' => 'processing time',
            'has_custom_text' => 'enabling or disabling custom text',
            'has_custom_image' => 'enabling or disabling custom image',
            'has_variations' => 'enabling or disabling variations',
            'has_inventory' => 'enabling or disabling inventory',
            'has_giftwrap' => 'enabling or disabling giftwrap',
            //'product_state_id' => 'product state',
            'category_id' => 'category',
            'productVariation.*.sku.*' => 'variation sku',
            'productVariation.*.description.*' => 'variation description',
            'productVariation.*.var_price_array.*' => 'variation price',
            'productVariation.*.var_quantity_array.*' => 'variation quantity',
            'productVariation.*.var_option_id_array.*' => 'variation type option',
            'image_path.*' => 'image',
        ];
    }
}
