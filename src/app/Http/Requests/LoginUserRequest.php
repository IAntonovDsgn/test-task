<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login-email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'login-password' => ['required', 'ascii'],
        ];
    }

    public function messages(): array
    {
        return [
            'login-email.required' => 'Заполните поле',
            'login-email.email' => 'Введите корректный Email',
            'login-email.regex' => 'Введите корректный Email',
            'login-password.required' => 'Заполните поле',
            'login-password.ascii' => 'Неверный пароль'
        ];
    }
}
