<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Chapter extends Model
{
    use HasFactory;
    protected $table = 'chapters';

    protected $fillable = ['chapter_name','teacher_id','subject_id'];

    public function teacher()
    {
        return $this->belongsTo(Admin::class);
    }


    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function scopeOfTeacher($query){
        return $query->where('teacher_id', Teacher::where('account_id', Auth::user()->id)->first()->id);
    }

}
