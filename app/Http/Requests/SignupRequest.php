<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'username' => 'required|min:6|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => __('validation.required', ['attribute' => __('user.username')]),
            'email.required' => __('validation.required', ['attribute' => __('user.email')]),
            'email.email' => __('validation.email', ['attribute' => __('user.username')]),
            'password.required' => __('validation.required', ['attribute' => __('user.password')]),
            'confirmed' => __('validation.confirmed', ['attribute' => __('user.password')]),
            'username.min' => __('validation.min.numeric', ['attribute' => __('user.username'), 'min' => 6]),
            'password.min' => __('validation.min.numeric', ['attribute' => __('user.password'), 'min' => 6]),
        ];
    }
}
