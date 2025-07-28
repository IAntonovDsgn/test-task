<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'email' => [
                'email',
                'max:50',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
            'password' => [
                'required',
                'max:255',
                'min:8',
                'confirmed',
                'ascii'
            ],
            'password_confirmation' => [
                'same:password',
                'required'
            ],
            'token' => [
                'required'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Заполните поле',
            'password.max' => 'Максимальная длина поля 255 символов',
            'password.min' => 'Минимальная длина пароля 8 символов',
            'password.ascii' => 'Пароль может содержать только латинские буквы верхнего и нижнего регистра, а также спецсимволы',
            'password.confirmed' => 'Пароли не совпадают',
            'password_confirmation.same' => 'Пароли не совпадают',
            'password_confirmation.required' => 'Заполните поле',
            'email.max' => 'Максимальная длина поля 50 символов',
            'email.email' => 'Введите корректный email',
            'email.regex' => 'Введите корректный email'
        ];
    }
}
