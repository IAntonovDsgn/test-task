<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'user_id' => ['string', 'exists:users,id', 'sometimes'],
            'title' => ['string', 'max:200', 'required'],
            'text' => ['string', 'required']
        ];
    }

    public function messages(): array
    {
        return [
            'user_id' => 'Неверный id пользователя',
            'title.max' => 'Максимальная длина поля 200 символов',
            'title.required' => 'Заполните поле',
            'text.required' => 'Заполните поле'
        ];
    }
}
