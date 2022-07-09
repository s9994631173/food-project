<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:3|max:255'
        ];
    }

    public function messages(){
        return [
            'email.required' => 'Не указана почта пользователя',
            'email.email' => 'Почта указана некорректно',
            
            'password.required' => 'Не указан пароль пользователя',
            'password.min' => 'Пароль пользователя не может быть менее 3 символов',
            'password.max' => 'Пароль пользователя не может быть более 255 символов'
        ];
    }
}
