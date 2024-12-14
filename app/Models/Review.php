<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'question',
        'answer',
        'correct_answer',
        'lesson_id',
        'teacher_id',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
    public function tests()
    {
        return $this->belongsToMany(Test::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function scopeOfTeacher($query){
        return $query->where('teacher_id', Teacher::where('account_id', Auth::user()->id)->first()->id);
    }
}
