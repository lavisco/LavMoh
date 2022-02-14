<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'name' => 'required|max:400',
            'slug' => 'nullable',
            'banner' => 'nullable',
            'url' => 'nullable',
            'about' => 'required|max:500',
            'rating' => 'nullable|integer',
            'country' => 'required|max:80',
            'province' => 'required',
            'district' => 'required',
            'city' => 'required',
            'area' => 'nullable',
            'address' => 'required|max:500',
            'zipcode' => 'max:12|nullable',
        ];
    }
}
