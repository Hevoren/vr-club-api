<?php

namespace App\Http\Requests\Update;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class ComputerUpdateRequest extends BaseFormRequest
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
                'graphic_card' => 'required|max:255',
                'processor' => 'required|max:255',
                'ram' => 'required|max:255',
            ];
        } else {
            return [
                'graphic_card' => 'sometimes|required|max:255',
                'processor' => 'sometimes|required|max:255',
                'ram' => 'sometimes|required|max:255',
            ];
        }

    }
}
