<?php

namespace App\Http\Requests\Update;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class RoomUpdateRequest extends BaseFormRequest
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
                'type_room' => 'required|max:255',
                'vr_device_id' => 'required|integer',
                'employee_id' => 'required|integer',
                'price' => 'required|numeric',
            ];
        } else {
            return [
                'type_room' => 'sometimes|required|max:255',
                'vr_device_id' => 'sometimes|required|integer',
                'employee_id' => 'sometimes|required|integer',
                'price' => 'sometimes|required|numeric',
            ];
        }
    }
}
