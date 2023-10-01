<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function Students() : BelongsToMany {
        return $this->belongsToMany(Student::class)
                ->as('result')
                ->withPivot(['final_score', 'started_at', 'ended_at'])
                ->withTimestamps();
    }
}
