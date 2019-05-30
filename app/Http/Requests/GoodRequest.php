<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoodRequest extends FormRequest
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
        'gname' => 'required',
        'gcompany' => 'required',
        'gdescr' => 'required',
        'gprice' => 'required',
        'gtock' => 'required',
        'size' => 'required',
        'xinghao' => 'required',
        'gpic' => 'required',
   
        ];
    }
    /**
         * 获取已定义验证规则的错误消息。
         *
         * @return array
         */
        public function messages()
        {
            return [
                'gname.required' => '不能为空',
                'gcompany.required' => '不能为空',
                'gdescr.required' => '不能为空',
                'gprice.required' => '不能为空',
                'gtock.required' => '不能为空',
                'size.required' => '不能为空',
                'xinghao.required' => '不能为空',
                'gpic.required' => '不能为空',
            ];
        }
}
