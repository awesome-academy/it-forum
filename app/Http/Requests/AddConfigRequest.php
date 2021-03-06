<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddConfigRequest extends FormRequest
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
            'name' => 'required|unique:configs,name',
            'content' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('admin.form.name')]),
            'content.required' => __('validation.required', ['attribute' => __('admin.form.content')]),
            'name.unique' => __('validation.unique', ['attribute' => __('admin.form.name')]),
            'content.min' => __('validation.min.numeric', ['attribute' => __('admin.form.content'), 'min' => 6]),
        ];
    }
}
