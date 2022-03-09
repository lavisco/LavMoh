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
            'variation_description.*' => 'max:500|nullable',
            'variation_price.*' => 'numeric|nullable',
            'variation_quantity.*' => 'integer|nullable',
            'variation_type.*' => 'required',
            'variation_type_option.*' => 'required',
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
            'variation_description.*' => 'variation description',
            'variation_price.*' => 'variation price',
            'variation_quantity.*' => 'variation quantity',
            'variation_type.*' => 'variation type',
            'variation_type_option.*' => 'variation type option',
        ];
    }
}
