<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Exam extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'total_question',
        'timer',
        'timer_per_question',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope a query to only include active exams.
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function students() : BelongsToMany {
        return $this->belongsToMany(Student::class)
                ->using(ExamStudent::class)
                ->as('result')
                ->withPivot(['final_score', 'started_at', 'ended_at']);
    }

    public function mine() : BelongsTo {
        return $this->belongsTo(Student::class)
                ->using(ExamStudent::class);
    }
}
