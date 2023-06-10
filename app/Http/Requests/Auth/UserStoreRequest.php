<?php

namespace App\Http\Requests\Auth;

use App\Rules\ValidationLogin;
use App\Rules\ValidationPassword;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'login' => ['required', 'unique:users', 'alpha', 'regex:/^[a-zA-Z]{3,20}$/'],
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}+$/'],
            'email' => 'required|email|unique:users',
            'role_id' => 'integer'
        ];

    }

    public function attributes()
    {
        return [
            'name' => 'Name',
            'surname' => 'Surname',
            'login' => 'Login',
            'email' => 'Email',
            'password' => 'Password'
        ];
    }

    public function messages()
    {
        return [
            'login.regex' => 'The :attribute must contain from 3 to 20 Latin characters.',
            'password.regex' => 'The :attribute must contain at least one lowercase letter, one uppercase letter and one digit.'
        ];
    }
}
