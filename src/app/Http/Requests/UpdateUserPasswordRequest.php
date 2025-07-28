<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPasswordRequest extends FormRequest
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
            'oldPassword' => [
                'required',
                'max:255',
                'min:8',
                'ascii',
            ],
            'newPassword' => [
                'required',
                'max:255',
                'min:8',
                'confirmed',
                'ascii',
            ],
            'newPassword_confirmation' => [
                'same:newPassword',
                'required',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'oldPassword.required' => 'Заполните поле пароль',
            'oldPassword.max' => 'Неверный пароль',
            'oldPassword.min' => 'Неверный пароль',
            'oldPassword.ascii' => 'Неверный пароль',
            'newPassword.required' => 'Заполните поле',
            'newPassword.max' => 'Максимальная длина поля 255 символов',
            'newPassword.min' => 'Минимальная длина пароля 8 символов',
            'newPassword.ascii' => 'Пароль может содержать только латинские буквы верхнего и нижнего регистра, а также спецсимволы',
            'newPassword.confirmed' => 'Пароли не совпадают',
            'newPassword_confirmation.same' => 'Пароли не совпадают',
            'newPassword_confirmation.required' => 'Заполните поле'
        ];
    }
}
