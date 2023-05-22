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
                'user_id' => 'required|integer',
                'reservation_time' => 'required|date',
                'peoples' => 'required|integer',
                'game_id' => 'required|integer',
                'room_id' => 'required|integer',
                'all_price' => 'required|numeric'
            ];
        } else {
            return [
                'user_id' => 'sometimes|required|integer',
                'reservation_time' => 'sometimes|required|date',
                'peoples' => 'sometimes|required|integer',
                'game_id' => 'sometimes|required|integer',
                'room_id' => 'sometimes|required|integer',
                'all_price' => 'sometimes|required|numeric'
            ];
        }
    }
}
