<?php

namespace App\Http\Requests\Store;

use App\Http\Requests\BaseFormRequest;

class ComputerStoreRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user !== null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'graphic_card' => 'required|max:255',
            'processor' => 'required|max:255',
            'ram' => 'required|max:255',
        ];
    }
}
