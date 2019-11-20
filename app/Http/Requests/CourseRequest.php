<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'category_id' => 'required|numeric',
            'name' => 'required|min:3|max:50',
            'description' => 'required',
            'status' => 'required|numeric|min:0|max:1',
        ];
    }
    public function messages()
    {
        return [
            'category_id.required' => trans('setting.category_id_required'),
            'category_id.numeric' => trans('setting.category_id_numeric'),
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
