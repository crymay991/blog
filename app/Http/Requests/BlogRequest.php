<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title' => 'required|min:4|max:32',
            'content' => 'required|min:20',
            'category_id' => 'required|gt:0',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.min' => '标题最少4个字',
            'title.max' => '标题最多32个字',
            'content.required' => '内容不能为空',
            'content.min' => '内容最少20个字',
            'category_id.required' => '分类必填',
            'category_id.gt' => '分类必填'
        ];
    }

}
