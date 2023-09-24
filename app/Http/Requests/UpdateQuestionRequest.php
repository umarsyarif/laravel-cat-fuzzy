<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'question' => ['required', 'string', 'max:255'],
            'multiple_choice' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'value' => ['required', 'numeric', 'max:255'],
        ];
    }
}
