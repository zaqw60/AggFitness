<?php

namespace App\Http\Requests\Skills;

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
            'location' => ['required', 'string', 'min:3', 'max:120'],
            'education' =>  ['required', 'string', 'min:3', 'max:600'],
            'experience' => ['required', 'numeric', 'min:1', 'max:127'],
            'achievements' =>  ['required', 'string', 'min:3', 'max:800'],
            'skills_list' =>  ['required', 'string', 'min:3', 'max:800'],
            'description' =>  ['required', 'string', 'min:3', 'max:800'],
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'Идентификатор пользователя',
            'location' => 'Расположение',
            'education' => 'Образование',
            'experience' => 'Опыт',
            'achievements' => 'Достижения',
            'skills_list' => 'Список навыков',
            'description' => 'Описание'
        ];
    }
}
