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
            'email' => ['email', 'max:50', 'unique:users'],
            'password' => [
                'required',
                'max:255',
                'min:8',
                'ascii',
            ],
            'new-password' => [
                'max:255',
                'min:8',
                'confirmed',
                'ascii',
            ],
            'new-password_confirmation' => ['same:new-password']
        ];
    }

    public function messages(): array
    {
        return [
            'name.max' => 'Максимальная длина поля 30 символов',
            'name.min' => 'Минимальная длина поля 2 символа',
            'email.max' => 'Максимальная длина поля 50 символов',
            'email.email' => 'Введите корректный email',
            'email.unique' => 'Такой e-mail уже есть в базе',
            'password.required' => 'Заполните поле пароль',
            'password.max' => 'Неверный пароль',
            'password.min' => 'Неверный пароль',
            'password.ascii' => 'Неверный пароль',
            'new-password.max' => 'Максимальная длина поля 255 символов',
            'new-password.min' => 'Минимальная длина пароля 8 символов',
            'new-password.ascii' => 'Пароль может содержать только латинские буквы верхнего и нижнего регистра, а также спецсимволы',
            'new-password.confirmed' => 'Пароли не совпадают',
            'new-password_confirmation.same' => 'Пароли не совпадают',
            'new-password_confirmation.required' => 'Заполните поле'
        ];
    }
}
