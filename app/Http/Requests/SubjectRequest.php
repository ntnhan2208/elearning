<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'subject_name' => 'required',
        ];
    }

    public function messages(){
        return [
            'subject_name.required' => 'Tên Môn học không được để trống',
        ];
    }
}
