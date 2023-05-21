<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class RoomStoreRequest extends FormRequest
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
            'type_room' => 'required|max:255',
            'vr_device_id' => 'required|integer',
            'employee_id' => 'required|integer',
            'price' => 'required|numeric',
        ];
    }
}
