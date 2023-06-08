<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class ReservationUpdateRequest extends FormRequest
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
                'login' => 'required',
                'reservation_time' => 'required|date|after:now',
                'peoples' => 'required|integer',
                'game_id' => 'required|integer',
                'room_id' => 'required|integer',
                'all_price' => 'required|numeric'
            ];
        } else {
            return [
                'login' => 'sometimes|required',
                'reservation_time' => 'sometimes|required|date|after:now',
                'peoples' => 'sometimes|required|integer',
                'game_id' => 'sometimes|required|integer',
                'room_id' => 'sometimes|required|integer',
                'all_price' => 'sometimes|required|numeric'
            ];
        }
    }
}
