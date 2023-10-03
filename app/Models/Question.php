<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'question',
        'multiple_choice',
        'value',
        'answer',
        'category',
    ];

    protected $casts = [
        'multiple_choice' => 'object',
    ];

    /**
     * Scope a query to get first question.
     */
    public function scopeStartingQuestion(Builder $query): void
    {
        $query->where('value', 0.2)->inRandomOrder();
    }


    /**
     * Scope a query to get next question.
     */
    public function scopeNextQuestion(Builder $query, $answeredQuestion, $newValue): void
    {
        $query->whereNotIn('id', $answeredQuestion->pluck('question_id'))
                ->where('value', $newValue)
                ->inRandomOrder();
    }
}
