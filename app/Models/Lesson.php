<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lessons';
    protected $fillable = ['lesson_name', 'teacher_id', 'chapter_id'];

    public function scopeOfTeacher($query){
        return $query->where('teacher_id', Teacher::where('account_id', Auth::user()->id)->first()->id);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
