<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'phone' => 'required|min:10|numeric',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('setting.name_required'),
            'name.min' => trans('setting.name_min'),
            'name.max' => trans('setting.name_max'),
            'phone.required' => trans('setting.phone_required'),
            'phone.min' => trans('setting.phone_min'),
            'phone.numeric' => trans('setting.phone_numeric'),
            'address.required' => trans('setting.address_required'),
        ];
    }
}
