<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class UserRequestStoreRequest extends FormRequest
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
            'phone_number' => 'required|regex:/^8\(\d{3}\)\s\d{3}-\d{2}-\d{2}$/'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
            'phone_number' => 'Phone number'
        ];
    }

    public function messages()
    {
        return [
            'phone_number.regex' => ':attribute must be in format 8 (###) ###-##-##'
        ];
    }
}
