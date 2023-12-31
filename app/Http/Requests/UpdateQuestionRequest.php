<?php

namespace App\Http\Requests;

use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'question_code' => ['required', 'string', 'max:10', 'unique:'.Question::class.',question_code,'.$this->id],
            'question' => ['required'],
            'multiple_choice' => ['required'],
            'answer' => ['required'],
            'difficulty_level' => ['required', 'numeric', 'between:-4, 4'],
            'different_power' => ['required', 'numeric', 'between:0, 2'],
        ];
    }
}
