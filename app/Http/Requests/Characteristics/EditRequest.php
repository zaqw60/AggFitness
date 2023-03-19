<?php

namespace App\Http\Requests\Characteristics;

use App\Models\Characteristic;
use Illuminate\Validation\Rule;
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
            'location' => ['required', 'string', 'min: 3', 'max: 150'],
            'height' => ['required', 'integer'],
            'weight' => ['required', 'integer'],
            'health' => ['required', Rule::in([Characteristic::HEALTH_A, Characteristic::HEALTH_B, Characteristic::HEALTH_C, Characteristic::HEALTH_D])],
            'description' => ['required', 'min: 3', 'max: 1500']

        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'Идентификатор клиента',
            'location' => 'Город',
            'height' => 'Рост',
            'weight' => 'Вес',
            'health' => 'Группа здоровья',
            'description' => 'Описание',
        ];
    }
}
