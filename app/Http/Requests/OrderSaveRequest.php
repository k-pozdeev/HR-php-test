<?php

namespace App\Http\Requests;

use App\Order;
use Illuminate\Foundation\Http\FormRequest;

class OrderSaveRequest extends FormRequest
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
            'client_email' => 'email|required',
            'partner_id' => 'required|exists:partners,id',
            'status' => 'required|in:' . Order::STATUS_NEW . ',' . Order::STATUS_APPROVED . ',' . Order::STATUS_COMPLETE
        ];
    }

    public function messages()
    {
        return [
            'client_email.email' => 'Некорректный e-mail',
            'client_email.required' => 'Обязательное поле',
            'partner_id.required' => 'Обязательное поле',
            'partner_id.exists' => 'Такой партнер не найден в базе',
            'status.required' => 'Обязательное поле',
            'status.in' => 'Некорректное значение статуса',
        ];
    }
}
