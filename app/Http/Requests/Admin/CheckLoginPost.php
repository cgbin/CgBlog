<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;


class CheckLoginPost extends FormRequest
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
            'username' => 'required|min:5|max:20',
            'password' => 'required',
            'captcha'  => 'required|captcha',
        ];
    }




    public function messages()
    {
        return [
            'username.required' => '用户名为必填项',
            'username.min' => '用户名不少于6位',
            'username.max' => '用户名最多20位',
            'password.required'  => '密码为必填项',
            'captcha.required'  => '验证码为必填项',
            'captcha.captcha'  => '验证码错误',
        ];
    }
}
