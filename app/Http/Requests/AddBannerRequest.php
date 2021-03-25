<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBannerRequest extends FormRequest
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
            'name' => 'required',
            'img_banner' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng điền đầy đủ thông tin!',
            'img_banner.required' => 'Vui lòng điền đầy đủ thông tin!'
        ];
    }
}
