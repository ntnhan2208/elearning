<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'class_name' => 'required',
            'quantity' => 'required',
        ];
    }

    public function messages(){
        return [
            'class_name.required' => 'Tên Lớp học không được để trống',
            'quantity.required' => 'Sỉ số lớp học không được để trống',
        ];
    }
}
