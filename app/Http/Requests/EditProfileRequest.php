<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'username' => 'required|alpha_dash|between:3,20|unique:users,username,' . \Auth::id(),
            'fullname' => 'required|max:100',
            'address' => 'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            'between' => __('validation.between.string', [
                'attribute' => __('user.username'),
                'min' => 3,
                'max' => 20,
            ]),
            'username.unique' => __('validation.unique', ['attribute' => __('user.username')]),
            'username.required' => __('validation.required', ['attribute' => __('user.username')]),
            'fullname.max' => __('validation.max.string', ['attribute' => __('user.fullname'), 'max' => 100]),
            'username.required' => __('validation.required', ['attribute' => __('user.username')]),
            'address.max' => __('validation.max.string', ['attribute' => __('user.address'), 'max' => 100]),
            'address.required' => __('validation.required', ['attribute' => __('user.address')]),
        ];
    }
}
