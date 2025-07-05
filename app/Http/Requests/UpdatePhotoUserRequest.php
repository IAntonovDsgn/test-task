<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhotoUserRequest extends FormRequest
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
            'photo' => ['image', 'max:2048', 'mimes:jpeg,png,jpg,gif,svg']
        ];
    }

    public function messages(): array
    {
        return [
            'photo.image' => 'Выберите изображение с расширением jpeg, png, jpg, gif, svg',
            'photo.mimes' => 'Выберите изображение с расширением jpeg, png, jpg, gif, svg',
            'photo.max' => 'Максимальный размер файла 2Мб',
        ];
    }
}
