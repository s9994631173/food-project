<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'id' => 'numeric',
            'product' => 'required|min:3|max:255',
            'weight' => 'required|numeric',
            'pr' => 'required|numeric',
            'ft' => 'required|numeric',
            'cb' => 'required|numeric',
            'KKAL' => 'required|numeric',
            'type' => 'required|in:breakfast,brunch,lunch,lunch2,dinner,dinner2'
        ];
    }

    public function messages(){
        return [
            'date.required' => 'Не указана дата',
            'date.date' => 'Дата указана некорректно',

            'id.numeric' => 'ID должно быть числом',

            'product.required' => 'Не указано название продукта',
            'product.min' => 'Название продукта должно быть от 3 до 255 символов',
            'product.max' => 'Название продукта должно быть от 3 до 255 символов',

            'weight.required' => 'Не указан вес',
            'weight.numeric' => 'Вес указан некорректно',

            'pr.required' => 'Не указано количество белка',
            'pr.numeric' => 'Колчичество белка указано некорректно',

            'ft.required' => 'Не указано количество жиров',
            'ft.numeric' => 'Количество жиров указано некорректно',

            'cb.required' => 'Не указано количество углеводов',
            'cb.numeric' => 'Количество углеводов указано некорректно',

            'KKAL.required' => 'Не указано количество ККАЛ',
            'KKAL.numeric' => 'Количество ККАЛ указано некорректно',

            'type.required' => 'Не указан тип приема пищи',
            'type.in' => 'Тип приема пищи указан некорректно'
        ];
    }
}
