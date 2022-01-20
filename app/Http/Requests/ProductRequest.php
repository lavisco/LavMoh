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
                'required',
                'max:16',
                Rule::unique('products')->ignore($this->id),
            ],
            'code' => 'nullable',
            'title' => 'max:255|required',
            'description' => 'max:500|required',
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
            'productVariation.*.var_option_id_array.*' => 'required|sometimes',
            'productVariation.*.var_quantity_array.*' => 'integer|nullable',
            'productVariation.*.var_price_array.*' => 'numeric|nullable',
            'productVariation.*.description.*' => 'max:500|nullable',
            'image_path.*' => 'required',
        ];
    }
}
