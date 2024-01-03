<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ExamStudent extends Pivot
{
    use HasFactory;

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public $incrementing = true;

    public function getNextQuestion() : ExamStudentQuestion | null {
        $questions = $this->questions()->get();
        // don't return anything if the exam ended
        if ($this->ended_at || $questions->count() == $this->exam->total_question){
            return null;
        }
        // if no question, create 1st question
        if (!$questions->count()){
            $newQuestion = Question::startingQuestion()->first();
            return $this->questions()->create(['question_id' => $newQuestion->id]);
        }
        // if there is a questions with no answer, return unanswered question
        if ($questions->containsStrict('is_correct', null)){
            return $questions->whereNull('is_correct')->first();
        }
        // else, create new question
        $lastQuestion = $questions->last();
        $newDiffPower = $lastQuestion->is_correct ?
                            $lastQuestion->question->difficulty_level + $lastQuestion->question->different_power :
                            $lastQuestion->question->difficulty_level - $lastQuestion->question->different_power;
        $answeredQuestions = $questions->whereNotNull('is_correct');
        $newQuestion = Question::nextQuestion($answeredQuestions, $newDiffPower, $lastQuestion->is_correct)->first();
        return $newQuestion ? $this->questions()->create(['question_id' => $newQuestion->id]) : null;
    }

    public function questions() : HasMany {
        return $this->hasMany(ExamStudentQuestion::class, 'exam_student_id', 'id')->orderBy('created_at');
    }

    public function exam() : BelongsTo {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }
}
