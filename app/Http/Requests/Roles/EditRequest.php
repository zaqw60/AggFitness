<?php

namespace App\Http\Requests\Roles;

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
            'role' => ['required',  'string', 'min:3', 'max:120'],
            'title' => ['required', 'string', 'min:3', 'max:120'],
            'description' =>  ['required', 'string', 'min:3', 'max:600']
        ];
    }

    public function attributes(): array
    {
        return [
            'role' => 'Роль',
            'title' => 'Название',
            'description' => 'Описание'
        ];
    }
}
