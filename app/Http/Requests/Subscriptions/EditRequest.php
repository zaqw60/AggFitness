<?php

namespace App\Http\Requests\Subscriptions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditRequest extends FormRequest
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
            'phone' => ['nullable', 'regex:/\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}/', 'min:18'],
            'email' => ['required', 'email', 'min:5', 'max:255'],
            'status' => ['required', 'string',
                Rule::in([
                    \App\Models\Subscription::IS_SUBSCRIBED,
                    \App\Models\Subscription::IS_UNSUBSCRIBED
                    ])
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'phone' => 'Телефон',
            'email' => 'Электронная почта',
            'status' => 'Статус'
        ];
    }
}
