<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class VrDeviceUpdateRequest extends FormRequest
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
        $method = $this->method();
        if ($method === 'PUT') {
            return [
                'vr_glasses' => 'required|max:255',
                'controller' => 'required|max:255',
                'computer_id' => 'required|integer'
            ];
        } else {
            return [
                'vr_glasses' => 'sometimes|required|max:255',
                'controller' => 'sometimes|required|max:255',
                'computer_id' => 'sometimes|required|integer'
            ];
        }
    }
}
