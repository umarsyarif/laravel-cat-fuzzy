<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'question_code',
        'question',
        'multiple_choice',
        'answer',
        'difficulty_level',
        'different_power',
    ];

    protected $casts = [
        'multiple_choice' => 'object',
    ];

    protected static function boot()
    {
        parent::boot();

        // Override creating
        // self::created(function (Question $model) {
        //     $model->attributes['question_code'] = 'M' . str_pad($model->id, 3, '0', STR_PAD_LEFT);
        //     $model->save();
        // });
    }

    protected function questionCode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::upper($value),
            get: fn ($value) => Str::upper($value),
        );
    }

    protected function difficultyLevel(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => round($value, 2),
            get: fn ($value) => number_format((float)$value, 2, '.', ''),
        );
    }

    protected function differentPower(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => round($value, 2),
            get: fn ($value) => number_format((float)$value, 2, '.', ''),
        );
    }

    public function fuzzyDifficultyLevel(): Attribute
    {
        return Attribute::make(
            get: fn () =>
            [
                'turun' => (0.8 - $this->difficulty_level) / (0.8 - 0.3),
                'naik' => ($this->difficulty_level - 0.3) / (0.8 - 0.3)
            ]
        );
    }

    public function fuzzyDifferentPower(): Attribute
    {
        return Attribute::make(
            get: fn () => [
                'turun' => (0.8 - $this->different_power) / (0.8 - 0.3),
                'naik' => ($this->different_power - 0.3) / (0.8 - 0.3)
            ],
        );
    }

    public function inferenceα(): Attribute
    {
        return Attribute::make(
            get: fn () => [
                // $μdifficultyLevel turun && $μdifferentPower turun = kemampuan turun
                min($this->fuzzy_difficulty_level['turun'], $this->fuzzy_differentpower['turun']),
                // $μdifficultyLevel turun && $μdifferentPower naik = kemampuan turun
                min($this->fuzzy_difficultylevel['turun'], $this->fuzzy_differentpower['naik']),
                // $μdifficultyLevel naik && $μdifferentPower turun = kemampuan naik
                min($this->fuzzy_difficultylevel['naik'], $this->fuzzy_differentpower['turun']),
                // $μdifficultyLevel naik && $μdifferentPower naik = kemampuan naik
                min($this->fuzzy_difficultylevel['naik'], $this->fuzzy_differentpower['naik']),
            ],
        );
    }

    public function inferencez(): Attribute
    {
        return Attribute::make(
            get: fn () => [
                $this->difficulty_level - ($this->difficulty_level - $this->different_power) * $this->inferenceα[0],
                $this->difficulty_level - ($this->difficulty_level - $this->different_power) * $this->inferenceα[1],
                (($this->difficulty_level - $this->different_power) * $this->inferenceα[2]) + $this->different_power,
                (($this->difficulty_level - $this->different_power) * $this->inferenceα[3]) + $this->different_power,
            ],
        );
    }

    public function newTheta(): Attribute
    {
        return Attribute::make(
            get: fn () => round((($this->inferenceα[0] * $this->inferencez[0]) + ($this->inferenceα[1] * $this->inferencez[1]) + ($this->inferenceα[2] * $this->inferencez[2]) + ($this->inferenceα[3] * $this->inferencez[3])) / array_sum($this->inferenceα), 2)
        );
    }

    /**
     * Scope a query to get first question.
     */
    public function scopeStartingQuestion(Builder $query): void
    {
        $query->where('difficulty_level', 0.23)->inRandomOrder();
    }


    /**
     * Scope a query to get next question.
     */
    public function scopeNextQuestion(Builder $query, $answeredQuestion, $newValue, $isCorrect): void
    {
        $query->whereNotIn('id', $answeredQuestion->pluck('question_id'))
                ->where('difficulty_level', $isCorrect ? '>' : '<', $newValue)
                ->orderBy('difficulty_level', $isCorrect ? 'ASC' : 'DESC');
    }

    // public function getNewTheta() {
    //     // pembentukan himpunan Fuzzy
    //     // a = different power, b = difficulty level
    //     $a = $this->different_power;
    //     $b = $this->difficulty_level;

    //     // μturun = (0,8-x)/(0,8-0,3)
    //     // μnaik = (x-0,3)/(0,8-0,3)
    //     $μdifficultyLevel = [
    //         'turun' => (0.8 - $b) / (0.8 - 0.3),
    //         'naik' => ($b - 0.3) / (0.8 - 0.3)
    //     ];
    //     $μdifferentPower = [
    //         'turun' => (0.8 - $a) / (0.8 - 0.3),
    //         'naik' => ($a - 0.3) / (0.8 - 0.3)
    //     ];

    //     // inferensi
    //     // αn = $α[-n]
    //     $α = [
    //         // $μdifficultyLevel turun && $μdifferentPower turun = kemampuan turun
    //         min($μdifficultyLevel['turun'], $μdifferentPower['turun']),
    //         // $μdifficultyLevel turun && $μdifferentPower naik = kemampuan turun
    //         min($μdifficultyLevel['turun'], $μdifferentPower['naik']),
    //         // $μdifficultyLevel naik && $μdifferentPower turun = kemampuan naik
    //         min($μdifficultyLevel['naik'], $μdifferentPower['turun']),
    //         // $μdifficultyLevel naik && $μdifferentPower naik = kemampuan naik
    //         min($μdifficultyLevel['naik'], $μdifferentPower['naik']),
    //     ];

    //     // zn = $z[-n]
    //     $z = [
    //         $b - ($b - $a) * $α[0],
    //         $b - ($b - $a) * $α[1],
    //         (($b - $a) * $α[2]) + $a,
    //         (($b - $a) * $α[3]) + $a,
    //     ];

    //     // defuzzifikasi
    //     $newTheta = (($α[0] * $z[0]) + ($α[1] * $z[1]) + ($α[2] * $z[2]) + ($α[3] * $z[3])) / array_sum($α);
    //     return $newTheta;
    // }
}
