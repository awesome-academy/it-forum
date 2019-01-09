<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPostRequest extends FormRequest
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
            'title' => 'required|min:6|unique:posts,title,' . $this->id,
            'content' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => __('validation.required', ['attribute' => __('admin.form.title')]),
            'content.required' => __('validation.required', ['attribute' => __('admin.form.content')]),
            'title.unique' => __('validation.unique', ['attribute' => __('admin.form.title')]),
            'title.min' => __('validation.min.numeric', ['attribute' => __('admin.form.title'), 'min' => 6]),
            'content.min' => __('validation.min.numeric', ['attribute' => __('admin.form.content'), 'min' => 6]),
        ];
    }
}
