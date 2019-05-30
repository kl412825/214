<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormsRequest extends FormRequest
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
            //
        'uname' => 'required|regex:/^[a-zA-Z][A-Za-z0-9_]{5,11}$/|unique:user',
        'password' => 'required|regex:/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[\W_]).{6,20}$/',
        'repass' => 'required|same:password',
        'email' => 'required|email',
        'phone' => 'required|regex:/^1[34578]\d{9}$/'
        
        ];
    }


    //获取已定义验证规则的错误消息
    public function messages()
    {
    	return [
    	'uname.required' => '用户不能为空',
        'uname.regex'  => '用户名格式不正确',
        'uname.unique'  => '用户名已存在',
        'password.required' => '密码不能为空',
        'password.regex' => '密码格式不正确',
        'repass.required' => '确认密码不能为空',
        'repass.same' => '两次密码不一致',
        'email.required' => '邮箱不能为空',
        'email.email' => '邮箱个是不正确',
        'phone.required' => '手机号不能为空',
        'phone.regex' => '手机号格式不正确',
        
    ];
    }
}
