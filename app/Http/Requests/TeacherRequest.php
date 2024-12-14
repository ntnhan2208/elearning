<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required',
                    'email' => 'required|email|unique:admins',
                    'phone' => 'required|max:10|unique:admins',
                    'password' => 'required',
                ];
            case 'PATCH':
            case 'PUT':
                return [
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|max:10',
                ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên Giáo viên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email bị trùng',
            'phone.unique' => 'Số điện thoại bị trùng',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.max' => 'Số điện thoại không quá 10 số',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống',
        ];
    }
}
