<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
            'name' => 'sometimes|required|string|max:255',
            'email' => [
                'required',
                'sometimes',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->id),
            ],
            'total' => 'numeric|required',
            'subtotal' => 'numeric|required',
            'giftwrap_price' => 'numeric|nullable',
            'shipping_price' => 'numeric|required',
            'discount_price' => 'numeric|nullable',
        ];
    }
}
