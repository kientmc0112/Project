<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|min:3|max:50|unique:users,email,'.$this->id,
            'password' => 'required|min:6|max:16',
            'repassword' => 'required|min:6|max:16',
            'phone' => 'required|min:10|numeric',
            'address' => 'required',
            'role_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('setting.name_required'),
            'name.min' => trans('setting.name_min'),
            'name.max' => trans('setting.name_max'),
            'email.required' => trans('setting.email_required'),
            'email.min' => trans('setting.email_min'),
            'email.max' => trans('setting.email_max'),
            'email.email' => trans('setting.email_email'),
            'email.unique' => trans('setting.email_unique'),
            'password.required' => trans('setting.password_required'),
            'password.min' => trans('setting.password_min'),
            'password.max' => trans('setting.password_max'),
            'phone.required' => trans('setting.phone_required'),
            'phone.min' => trans('setting.phone_min'),
            'phone.numeric' => trans('setting.phone_numeric'),
            'address.required' => trans('setting.address_required'),
            'role_id.required' => trans('setting.role_id_required'),
            'role_id.numeric' => trans('setting.role_numeric'),
        ];
    }
}
