<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditImageRequest extends FormRequest
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
            'image' => 'mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'image.mimes' => __('validation.mimes', ['attribute' => 'File', 'values' => 'jpeg,png,jpg']),
            'image.max' => __('validation.max.file', ['attribute' => 'File', 'max' => 2048]),
        ];
    }
}
