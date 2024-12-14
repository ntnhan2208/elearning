<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChapterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'chapter_name' => 'required',
        ];
    }

    public function messages(){
        return [
            'chapter_name.required' => 'Tên Chương bài học không được để trống',
        ];
    }
}
