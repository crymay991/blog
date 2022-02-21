<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:4|max:32',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名不能为空',
            'name.min' => '用户名不能小于4位',
            'name.max' => '用户名不能大于32位',
        ];
    }
}
