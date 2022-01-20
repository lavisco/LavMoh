<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductVariationRequest extends FormRequest
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
            'productVariation.*.sku.*' => [
                'nullable',
                'max:16',
                Rule::unique('product_variations')->ignore($this->id),
            ],
            'description' => 'max:500|nullable',
            'productVariation.var_price_array' => 'numeric|nullable',
            'quantity' => 'integer|nullable',
            'type' => 'required',
            'type_option' => 'required',
        ];
    }
}
