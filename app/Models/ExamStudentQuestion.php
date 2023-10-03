<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamStudentQuestion extends Model
{
    use HasFactory;

    protected $table = 'exam_student_questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'exam_student_id',
        'question_id',
        'answer',
        'is_correct'
    ];

    public function question() : BelongsTo {
        return $this->belongsTo(Question::class);
    }

    public function result() : BelongsTo {
        return $this->belongsTo(ExamStudent::class, 'exam_student_id', 'id');
    }
}
