<?php

namespace App\Http\Requests;

use App\Http\Requests\Contracts\AuthorizesAndValidatesRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class LoginRequest extends FormRequest implements AuthorizesAndValidatesRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    #[Override]
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<int, string>|string>
     */
    #[Override]
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    #[Override]
    public function messages(): array
    {
        return [
            'email.required' => 'Укажите email.',
            'email.email' => 'Некорректный формат email.',
            'password.required' => 'Укажите пароль.',
        ];
    }
}
