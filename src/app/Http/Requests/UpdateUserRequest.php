<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => ['max:30', 'min:2'],
            'email' => ['email', 'max:50', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'password' => [
                'required',
                'max:255',
                'min:8',
                'ascii',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.max' => 'Максимальная длина поля 30 символов',
            'name.min' => 'Минимальная длина поля 2 символа',
            'email.max' => 'Максимальная длина поля 50 символов',
            'email.email' => 'Введите корректный email',
            'email.regex' => 'Введите корректный email',
            'password.required' => 'Заполните поле пароль',
            'password.max' => 'Неверный пароль',
            'password.min' => 'Неверный пароль',
            'password.ascii' => 'Неверный пароль',
        ];
    }
}
