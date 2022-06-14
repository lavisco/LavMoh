<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GiftboxRequest extends FormRequest
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
            'title' => 'max:255|required',
            'short_description' => 'max:500|required',
            'base_price' => 'numeric|required',
            'processing_time' => 'max:20|required',
            'has_custom_text' => 'boolean|required',            
            //images
            'image_path' => 'required',
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
            'base_price' => 'base price',
            'processing_time' => 'processing time',
            'has_custom_text' => 'enabling or disabling custom text',

            //images
            'image_path' => 'primary image',
        ];
    }
}
