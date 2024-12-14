<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;

class AdminRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return[
            'email' => ['required', Rule::unique('admins')->ignore($this->admin,'id')],
            'name' => ['required', Rule::unique('admins')->ignore($this->admin,'id')],
            'phone' => ['regex:/^([0-9\s\-\+\(\)]*)$/','min:10', Rule::unique('admins')->ignore($this->admin,'id'),'nullable'],
            'images' => 'mimes:jpeg,jpg,png,gif|max:10000|nullable'
        ];
    }

    public function messages()
    {
        return [
            'email.unique' =>  trans('site.admin.validation.email_exist'),
            'name.unique' => trans('site.admin.validation.name_exist'),
            'name.required' => trans('site.admin.validation.name_not_empty'),
            'email.required' => trans('site.admin.validation.email_not_empty'),
            'phone.regex' => trans('site.admin.validation.phone_regex'),
            'phone.unique' => trans('site.admin.validation.phone_exist'),
            'phone.min' => trans('site.admin.validation.phone_min'),
            'images.mimes' => trans('site.admin.validation.image_mimes'),
            'images.max' => trans('site.admin.validation.image_max'),
        ];
    }
}
