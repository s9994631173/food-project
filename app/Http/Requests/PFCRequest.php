<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PFCRequest extends FormRequest
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
            'proteins' => 'required|numeric',
            'fats' => 'required|numeric',
            'carbohydrates' => 'required|numeric',
            'KKAL' => 'required|numeric'
        ];
    }

    public function messages(){
        return [
            'date.required' => 'Не указана дата',
            'date.date' => 'Дата указана некорректно',

            'proteins.required' => 'Не указано количество белков',
            'proteins.numeric' => 'Количество белков указано некорректно',

            'fats.required' => 'Не указано количество жиров',
            'fats.numeric' => 'Количество жиров указано некорректно',

            'carbohydrates.required' => 'Не указано количество углеводов',
            'carbohydrates.numeric' => 'Количество углеводов указано некорректно',

            'KKAL.required' => 'Не указано количество ККАЛ',
            'KKAL.numeric' => 'Количество ККАЛ указано некорректно'
        ];
    }
}
