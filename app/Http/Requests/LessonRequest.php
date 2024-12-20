<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'lesson_name' => 'required',
            'lesson_description' => 'required',
        ];
    }

    public function messages(){
        return [
            'lesson_name.required' => 'Tên Bài học không được để trống',
            'lesson_description.required' => 'Yêu cầu cần đạt không được để trống',
        ];
    }
}
