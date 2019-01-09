<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTagRequest extends FormRequest
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
            'name' => 'required|unique:tags,name,' . $this->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('admin.form.name')]),
            'name.unique' => __('validation.unique', ['attribute' => __('admin.form.name')]),
        ];
    }
}
