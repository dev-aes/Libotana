<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'name' => ['required'],
            'gender' => ['required'],
            'address' => ['required'],
            'contact' => ['required', 'digits:11'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
            'role_id' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'The email address has already been taken',
        ];
    }
}