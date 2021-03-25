<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNewsRequest extends FormRequest
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
            'category' => 'required',
            'post_author' => 'required',
            'keywords' => 'required',
            'title' => 'required',
            'short_content' => 'required',
            'editor' => 'required',
            'img_news' => 'required',
            'post_source' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category.required' => 'Vui lòng điền đầy đủ thông tin!',
            'post_author.required' => 'Vui lòng điền đầy đủ thông tin!',
            'keywords.required' => 'Vui lòng điền đầy đủ thông tin!',
            'title.required' => 'Vui lòng điền đầy đủ thông tin!',
            'short_content.required' => 'Vui lòng điền đầy đủ thông tin!',
            'editor.required' => 'Vui lòng điền đầy đủ thông tin!',
            'img_news.required' => 'Vui lòng điền đầy đủ thông tin!',
            'post_source.required' => 'Vui lòng điền đầy đủ thông tin!',
        ];
    }
}
