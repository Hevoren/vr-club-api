<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class VrDeviceStoreRequest extends FormRequest
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
            'vr_glasses' => 'required|max:255',
            'controller' => 'required|max:255',
            'computer_id' => 'required|integer'
        ];
    }
}
