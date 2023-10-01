<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreExamRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'timer' => ['required', 'numeric', 'gte:'.$this->timer_per_question*$this->total_question/60],
            'timer_per_question' => ['required', 'numeric', 'gte:5'],
            'total_question' => ['required', 'numeric'],
            'is_active' => ['required', 'boolean']
        ];
    }
}
