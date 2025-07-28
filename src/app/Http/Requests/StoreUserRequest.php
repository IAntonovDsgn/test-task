<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'max:30', 'min:2'],
            'email' => ['required', 'email', 'max:50', 'unique:users', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'password' => [
                'required',
                'max:255',
                'min:8',
                'confirmed',
                'ascii',
            ],
            'password_confirmation' => ['required', 'same:password'],
            'approval' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Заполните поле Логин / Имя пользователя',
            'name.max' => 'Максимальная длина поля 30 символов',
            'name.min' => 'Минимальная длина поля 2 символа',
            'email.required' => 'Заполните поле E-mail',
            'email.max' => 'Максимальная длина поля 50 символов',
            'email.unique' => 'Такой e-mail уже есть в базе',
            'email.regex' => 'Введите корректный Email',
            'email.email' => 'Введите корректный Email',
            'password.required' => 'Заполните поле пароль',
            'password.max' => 'Максимальная длина поля 255 символов',
            'password.min' => 'Минимальная длина пароля 8 символов',
            'password.ascii' => 'Пароль может содержать только латинские буквы верхнего и нижнего регистра, а также спецсимволы',
            'password.confirmed' => 'Пароли не совпадают',
            'password_confirmation.same' => 'Пароли не совпадают',
            'password_confirmation.required' => 'Заполните поле',
            'approval' => 'Согласие на обработку персональных данных обязательно для регистрации'
        ];
    }
}
