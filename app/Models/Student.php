<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nisn',
        'name',
        'gender',
        'address',
    ];

    public static function boot()
    {
        parent::boot();

        // on creating
        self::creating(function(Student $model){
            $user = User::create([
                'name' => $model->name,
                'username' => $model->nisn,
                'password' => '123456'
            ]);
            $model->user_id = $user->id;
        });

        // on updated
        self::updated(function(Student $model){
            $user = $model->user;
            $user->name = $model->name;
            $user->save();
        });

        // on deleted
        self::deleted(function(Student $model){
            $user = $model->user;
            $user->delete();
        });
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
