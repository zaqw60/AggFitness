<?php

namespace App\Http\Requests\GymAddress;

use App\Models\GymAddress;
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
            'gym_id' => ['required', 'integer'],
            'index' => ['required', 'integer', 'digits:6'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'street' => ['required', 'string'],
            'house_number' => ['required', 'integer', 'max:1000'],
            'building' => ['nullable', 'string'],
            'floor' => ['required', 'integer'],
            'apartment' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'gym_id' => 'Идентификатор фитнес-клуба',
            'index' => 'Индекс',
            'country' => 'Страна',
            'city' => 'Город',
            'street' => 'Улица',
            'house_number' => 'Дом',
            'building' => 'Строение',
            'floor' => 'Этаж',
            'apartment' => 'Квартира',
        ];
    }
}
