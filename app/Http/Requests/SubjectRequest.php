<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
            'status' => 'required|min:0|max:1|numeric',
            'description' => 'required',
            'duration' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('setting.name_required'),
            'name.min' => trans('setting.name_min'),
            'name.max' => trans('setting.name_required'),
            'description.required' => trans('setting.description_required'),
            'status.required' => trans('setting.status_required'),
            'status.min' => trans('setting.status_min'),
            'status.max' => trans('setting.status_required'),
            'status.numeric' => trans('setting.status_numeric'),
        ];
    }
}
