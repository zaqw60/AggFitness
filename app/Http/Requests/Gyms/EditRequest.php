<?php

namespace App\Http\Requests\Gyms;

use Illuminate\Foundation\Http\FormRequest;

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
            'user_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'min:3', 'max:250'],
            'phone_main' => ['required',  'regex:/\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}/', 'min:18'],
            'phone_second' => ['nullable', 'regex:/\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}/', 'min:18'],
            'email' => ['required', 'email', 'min:5', 'max:255'],
            'url' => ['required', 'string',  'min:3', 'max:800'],
            'description' =>  ['required', 'string', 'min:3', 'max:800']
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'Идентификатор пользователя',
            'title' => 'Наименование',
            'phone_main' => 'Телефон',
            'phone_second' => 'Дополнительный телефон',
            'email' => 'Электронная почта',
            'url' => 'Ссылка на оригинальный сайт',
            'description' => 'Описание',
        ];
    }
}
