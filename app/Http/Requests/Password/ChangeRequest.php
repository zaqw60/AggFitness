<?php

namespace App\Http\Requests\Password;

use Illuminate\Foundation\Http\FormRequest;

class ChangeRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'old_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required_with:confirmPassword', 'string', 'same:confirmPassword', 'min:8'],
            'confirmPassword' => ['required', 'string', 'min:8'],
        ];
    }

    /**
     *
     *  @return array
     * */

    public function attributes(): array
    {
        return [
            'old_password' => 'Старый пароль',
            'new_password' => 'Новый пароль',
            'confirmPassword' => 'Повторить пароль',
        ];
    }
}
