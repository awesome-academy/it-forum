<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPasswordRequest extends FormRequest
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
            'oldPassword' => 'required|between:6,20',
            'password' => 'required|between:6,20|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'confirmed' => __('validation.confirmed', ['attribute' => __('user.password')]),
            'between' => __('validation.between.string',
                [
                    'attribute' => __('user.password'),
                    'min' => 6,
                    'max' => 20,
                ]),
            'oldPassword.required' => __('validation.required', ['attribute' => __('user.oldPassword')]),
            'password.required' => __('validation.required', ['attribute' => __('user.password')]),
        ];
    }
}
