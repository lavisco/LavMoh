<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HomeSliderRequest extends FormRequest
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
            'order' => [
                'required',
                'numeric',
                Rule::unique('home_sliders')->ignore($this->id),
            ],
            'name' => 'required|max:100',
            'description' => 'required|max:200',
            'link_text' => 'required|max:20',
            'link' => 'required|max:300',
            'banner' => 'required',
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
            'display_picture' => 'display picture',
        ];
    }
}
