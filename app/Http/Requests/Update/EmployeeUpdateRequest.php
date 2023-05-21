<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
                'status_id' => 'required|numeric',
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'mid_name' => 'required|string|max:255',
                'salary' => 'required|numeric',
                'title' => 'required|string|max:255',
                'phone_number' => 'required|regex:/^\d{3}-\d{3}-\d{2}-\d{2}$/'
            ];
        } else {
            return [
                'status_id' => 'sometimes|required|numeric',
                'name' => 'sometimes|required|string|max:255',
                'surname' => 'sometimes|required|string|max:255',
                'mid_name' => 'sometimes|required|string|max:255',
                'salary' => 'sometimes|required|numeric',
                'title' => 'sometimes|required|string|max:255',
                'phone_number' => 'sometimes|required|regex:/^\d{3}-\d{3}-\d{2}-\d{2}$/'
            ];
        }
    }
}