<?php

namespace App\Http\Requests\Update;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class GameUpdateRequest extends BaseFormRequest
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
                'game' => 'required|max:255',
                'age_limit' => 'required|integer',
                'duration' => 'required|integer',
                'genre' => 'required|max:255',
                'price' => 'required|numeric'
            ];
        } else {
            return [
                'game' => 'sometimes|required|max:255',
                'age_limit' => 'sometimes|required|integer',
                'duration' => 'sometimes|required|integer',
                'genre' => 'sometimes|required|max:255',
                'price' => 'sometimes|required|numeric'
            ];
        }
    }
}
