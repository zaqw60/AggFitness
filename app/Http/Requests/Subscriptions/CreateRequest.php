<?php

namespace App\Http\Requests\Subscriptions;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the Subscription is authorized to make this request.
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
            'phone' => ['required', 'string', 'min:10', 'max:21'],
            'email' => ['required', 'nullable', 'email', 'min:5'],
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'Электронная почта',
            'phone' => 'Телефон',
        ];
    }
}
