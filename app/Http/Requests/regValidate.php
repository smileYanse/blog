<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class regValidate extends FormRequest
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
            'user_name' => 'required|max:45',
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'user_name:required' => '用户名不能为空',
            'email:require' => '邮箱不能为空',
            'email:email' => '邮箱地址不合法',
            'password:require' => '密码不能为空'
        ];
    }

}
