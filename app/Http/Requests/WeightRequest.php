<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightRequest extends FormRequest
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
            'date' => 'required|date',
            'weight' => 'required|numeric'
        ];
    }

    public function messages(){
        return [
            'date.requred' => 'Не указана дата',
            'date.date' => 'Дата указана некорректно',

            'weight.required' => 'Не указан вес',
            'weight.numeric' => 'Вес должен быть числом'
        ];
    }
}
