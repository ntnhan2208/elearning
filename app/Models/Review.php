<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Question\Question;

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

    public function scopeOfTeacher($query)
    {
        return $query->where('teacher_id', Teacher::where('account_id', Auth::user()->id)->first()->id);
    }

    public function questionsOfType($type, $idOfType)
    {
        $questions = [];
        switch ($type) {
            case 'subject':
                $chapters = Chapter::where('subject_id', $idOfType)->get();
                $lessons = [];
                foreach ($chapters as $chapter) {
                    foreach ($chapter->lessons->pluck('id')->toArray() as $value) {
                        $lessons[] = $value;
                    }
                }
                foreach ($lessons as $lesson) {
                    foreach (Review::where('lesson_id', $lesson)->pluck('id')->toArray() as $value) {
                        $questions[] = $value;
                    }
                }
                break;
            case 'chapter':
                $lessons = Lesson::where('chapter_id', $idOfType)->get();

                foreach ($lessons as $lesson) {
                    foreach (Review::where('lesson_id', $lesson->id)->pluck('id')->toArray() as $value) {
                        $questions[] = $value;
                    }
                }
                break;
            case 'lesson':
                $questions = Review::where('lesson_id', $idOfType)->pluck('id')->toArray();
                break;
        }
        return $questions;
    }
}
