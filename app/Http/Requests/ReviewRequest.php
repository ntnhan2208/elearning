<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'question' => 'required',
            'question_answer' => 'required',
        ];
    }

    public function messages(){
        return [
            'question.required' => 'Câu hỏi không được để trống',
            'question_answer.required' => 'Câu trả lời không được để trống',
        ];
    }
}
