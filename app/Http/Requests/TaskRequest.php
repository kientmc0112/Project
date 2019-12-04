<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'subject_id' => 'required|min:1|numeric',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('setting.name_required'),
            'name.min' => trans('setting.name_min'),
            'name.max' => trans('setting.name_required'),
            'description.required' => trans('setting.description_required'),
            'subject_id.required' => trans('setting.subject_id_required'),
            'subject_id.min' => trans('setting.subject_id_min'),
            'subject_id.numeric' => trans('setting.subject_id_numeric'),
        ];
    }
}
