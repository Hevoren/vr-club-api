<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        $isAuthorized = $user !== null && $user->tokenCan('create', 'update');

        if (!$isAuthorized) {
            $this->failedAuthorization(); // Call failedAuthorization method when authorization fails
        }

        return $isAuthorized;
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(response()->json(['error' => 'Forbidden'], 403));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
