<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'score' => 'required',
            'name' => 'required|max:100',
            'description' => 'required|max:300',
            'link' => 'required|max:300',
            'color' => 'required|max:10',
            'dispay_picture' => 'required|max:300',
        ];
    }
}
