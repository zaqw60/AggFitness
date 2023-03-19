<?php

namespace App\Http\Requests\TrainerReviews;

use App\Models\TrainerReview;
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
            'client_id' => ['required', 'integer'],
            'trainer_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'min:3', 'max:100'],
            'description' =>  ['required', 'string', 'min:3', 'max:800'],
            'score' => ['required', 'numeric', 'min:1', 'max:5'],
            'status' => ['required', Rule::in([TrainerReview::DRAFT, TrainerReview::ACTIVE, TrainerReview::BLOCKED])],
        ];
    }

    public function attributes(): array
    {
        return [
            'client_id' => 'Идентификатор пользователя',
            'trainer_id' => 'Идентификатор тренера',
            'title' => 'Тема отзыва',
            'description' => 'Текст отзыва',
            'score' => 'Оценка тренера',
            'status' => 'Статус отзыва',
        ];
    }
}
