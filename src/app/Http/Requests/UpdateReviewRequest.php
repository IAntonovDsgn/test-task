<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
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
            'id-update' => ['required', 'numeric', 'exists:reviews,id'],
            'title-update' => ['required', 'string', 'max:200'],
            'text-update' => ['required', 'string'],
            'recommend-update' => ['sometimes', 'numeric']
        ];
    }

    public function messages(): array
    {
        return [
            'id-update' => 'Отзыв не найден',
            'title.max' => 'Максимальная длина поля 200 символов',
            'title.required' => 'Заполните поле',
            'text.required' => 'Заполните поле'
        ];
    }
}
