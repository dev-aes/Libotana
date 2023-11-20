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
            // 'password' => ['required', 'confirmed'],
            'password' => ['required', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/'],
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'The email address has already been taken',
            'password.regex' => 'The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.',
        ];
    }
}