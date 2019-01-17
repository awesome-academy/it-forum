<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'fullname' => 'required|min:6',
            'username' => 'required|min:6|unique:users,username',
            'password' => 'required|min:6',
            'phone' => 'required|numeric|min:8',
            'birthday' => 'required|date',
            'gender' => 'required',
            'role_id' => 'required',
            'address' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('validation.required', ['attribute' => __('admin.form.email')]),
            'fullname.required' => __('validation.required', ['attribute' => __('admin.form.fullname')]),
            'username.required' => __('validation.required', ['attribute' => __('admin.form.username')]),
            'username.required' => __('validation.required', ['attribute' => __('admin.form.username')]),
            'phone.required' => __('validation.required', ['attribute' => __('admin.form.phone')]),
            'birthday.required' => __('validation.required', ['attribute' => __('admin.form.birthday')]),
            'gender.required' => __('validation.required', ['attribute' => __('admin.form.gender')]),
            'role_id.required' => __('validation.required', ['attribute' => __('admin.form.role_id')]),
            'address.required' => __('validation.required', ['attribute' => __('admin.form.address')]),
            'birthday.date' => __('validation.date', ['attribute' => __('admin.form.birthday')]),
            'phone.numeric' => __('validation.only_num', ['attribute' => __('admin.form.phone')]),
            'email.email' => __('validation.email', ['attribute' => __('admin.form.username')]),
            'email.unique' => __('validation.unique', ['attribute' => __('admin.form.email')]),
            'username.unique' => __('validation.unique', ['attribute' => __('admin.form.username')]),
            'fullname.min' => __('validation.min.numeric', ['attribute' => __('admin.form.fullname'), 'min' => 6]),
            'username.min' => __('validation.min.numeric', ['attribute' => __('admin.form.username'), 'min' => 6]),
            'password.min' => __('validation.min.numeric', ['attribute' => __('admin.form.password'), 'min' => 6]),
            'phone.min' => __('validation.min.numeric', ['attribute' => __('admin.form.phone'), 'min' => 8]),
            'address.min' => __('validation.min.numeric', ['attribute' => __('admin.form.address'), 'min' => 6]),
        ];
    }
}
