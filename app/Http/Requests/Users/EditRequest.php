<?php

namespace App\Http\Requests\Users;

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
            'status' => ['nullable', 'string'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => [
                'required',
                Rule::unique('users')
                    ->ignore($this->user),
                'min:5',
                'max:255'
            ],
            'phone' =>  [
                'nullable',
                Rule::unique('users')
                    ->ignore($this->user),
                'regex:/\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}/'
            ],
            'password' => ['required', 'min:8', 'max:50'],
            'newPassword' => ['nullable', 'min:8', 'max:50', 'confirmed'],
        ];
    }

    public function attributes(): array
    {
        return [
            'status' => 'Статус',
            'name' => 'Никнейм',
            'email' => 'Электронная почта',
            'phone' => 'Телефон',
            'password' => 'Пароль',
            'newPassword' => 'Новый пароль',
        ];
    }
}
