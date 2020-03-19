<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceEditRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'price' => 'integer|min:0|max:99999|required'
        ];
    }

    public function messages()
    {
        return [
            'price.integer' => 'Введите целое число',
            'price.min' => 'Минимальная цена 0',
            'price.max' => 'Максимальная цена 99999',
            'price.required' => 'Введите цену'
        ];
    }
}
