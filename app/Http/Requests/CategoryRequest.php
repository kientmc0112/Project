<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'parent_id' => 'required|numeric',
            'name' => 'required|min:3|max:50',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'parent_id.required' => trans('setting.parent_id_required'),
            'parent_id.numeric' => trans('setting.parent_id_numeric'),
            'name.required' => trans('setting.name_required'),
            'name.min' => trans('setting.name_min'),
            'name.max' => trans('setting.name_max'),
            'description.required' => trans('setting.description_required')
        ];
    }
}
