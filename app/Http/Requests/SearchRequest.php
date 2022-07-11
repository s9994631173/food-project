<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'product' => 'min:3|max:255',
            'prod_id' => 'numeric'
        ];
    }

    public function messages(){
        return [
            'product.min' => 'Название продукта должно быть от 3 до 255 символов',
            'product.max' => 'Название продукта должно быть от 3 до 255 символов',

            'prod_id.numeric' => 'ID продукта должно быть числом'
        ];
    }
}
