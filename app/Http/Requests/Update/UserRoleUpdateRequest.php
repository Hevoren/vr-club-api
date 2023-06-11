<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class UserRoleUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user !== null && $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'role_id' => 'required|integer|between:1,2'
        ];
    }

    public function attributes()
    {
        return [
            'role_id' => 'Role'
        ];
    }

    public function messages()
    {
        return [
            'role_id.between' => ':attribute must be between 1 and 2'
        ];
    }
}
