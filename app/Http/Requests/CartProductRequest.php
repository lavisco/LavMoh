<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartProductRequest extends FormRequest
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
            'base_price' => 'numeric|required',
            'quantity' => 'integer|required',
            'total' => 'numeric|required',
            'custom_text' => 'string|nullable',
            'custom_image' => 'string|nullable',
            'has_variations' => 'boolean|required',
        ];
    }
}
