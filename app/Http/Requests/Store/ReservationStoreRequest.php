<?php

namespace App\Http\Requests\Store;

use App\Http\Requests\BaseFormRequest;

class ReservationStoreRequest extends BaseFormRequest
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
            'login' => 'string|alpha',
            'user_id' => 'integer',
            'reservation_time' => 'required|date|after:now',
            'peoples' => 'required|integer',
            'game_id' => 'required|integer',
            'room_id' => 'required|integer'
        ];
    }
}
