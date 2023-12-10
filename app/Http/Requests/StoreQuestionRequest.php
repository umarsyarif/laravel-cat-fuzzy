<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreQuestionRequest extends FormRequest
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
            'question' => 'required|string|max:255',
            'multiple_choice' => 'required',
            'answer' => 'required',
            'difficulty_level' => 'required|numeric|between:-4,4',
            'different_power' => 'required|numeric|between:0,2',
        ];
    }
}
