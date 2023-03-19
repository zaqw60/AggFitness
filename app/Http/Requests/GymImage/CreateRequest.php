<?php

namespace App\Http\Requests\GymImage;

use App\Models\GymImage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
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
            'image' =>  ['required', 'image', 'mimes:jpg, png, jpeg']
        ];
    }

    public function attributes(): array
    {
        return [
            'gym_id' => 'Идентификатор фитнес-клуба',
            'image' => 'Изображение',
        ];
    }
}
