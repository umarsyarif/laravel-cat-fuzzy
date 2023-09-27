<?php

namespace App\Models;

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
}
