<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ExamStudent extends Pivot
{
    use HasFactory;

    public $incrementing = true;

    public function getNextQuestion() : ExamStudentQuestion|null {
        // don't return anything if exam ended
        if ($this->ended_at){
            return null;
        }
        $questions = $this->questions()->get();
        // get 1st question
        if (!$questions->count()){
            $newQuestion = Question::startingQuestion()->first();
            return $this->questions()->create(['question_id' => $newQuestion->id]);
            // return $newQuestion;
        }
        // return unanswered question
        if ($questions->contains('answer', null)){
            return $questions->whereNull('answer')->first();
        }
        // add new question
        $answeredQuestion = $questions->whereNotNull('answer');
        $isCorrect = $questions->last()->is_correct ? 0.1 : -0.1;
        $newValue = $questions->last()->question->value + $isCorrect;
        $newQuestion = Question::nextQuestion($answeredQuestion, $newValue)->first();
        return $this->questions()->create(['question_id' => $newQuestion->id]);
        // return $newQuestion;
    }

    public function questions() : HasMany {
        return $this->hasMany(ExamStudentQuestion::class, 'exam_student_id', 'id')->orderBy('created_at');
    }
}
