<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'email' => 'required|email',
            'fullname' => 'required|min:6',
            'username' => 'required|min:6',
            'password' => 'required|min:6',
            'phone' => 'required|numeric|min:6',
            'birthday' => 'required|date',
            'gender' => 'required',
            'role_id' => 'required',
            'address' => 'required|min:6',
        ];
    }
}
