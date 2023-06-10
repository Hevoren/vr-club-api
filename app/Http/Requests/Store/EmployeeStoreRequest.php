<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user !== null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'mid_name' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'title' => 'required|string|max:255',
            'phone_number' => 'required|regex:/^8\(\d{3}\)\s\d{3}-\d{2}-\d{2}$/'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
            'phone_number' => 'Phone number',
            'status_id' => 'Status',
            'surname' => 'Surname',
            'mid_name' => 'Mid name',
            'salary' => 'Salary',
            'title' => 'Title',
        ];
    }

    public function messages()
    {
        return [
            'phone_number.regex' => ':attribute must be in format 8 (###) ###-##-##'
        ];
    }
}
