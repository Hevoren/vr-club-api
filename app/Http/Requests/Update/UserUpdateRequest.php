<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $method = $this->method();
        if ($method === 'PUT') {
            return [
                'name' => 'required|max:255',
                'surname' => 'required|max:255',
                'login' => 'required|unique:users|alpha|min:3|max:20|regex:/^[a-zA-Z]+$/',
                'password' => 'required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'email' => 'required|email|',
                'role_id' => 'required|integer'
            ];
        } else {
            return [
                'name' => 'sometimes|required|max:255',
                'surname' => 'sometimes|required|max:255',
                'login' => 'sometimes|required|unique:users|alpha|min:3|max:20|regex:/^[a-zA-Z]+$/',
                'password' => 'sometimes|required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'email' => 'sometimes|required|email|',
                'role_id' => 'sometimes|required|integer'
            ];
        }
    }
}
