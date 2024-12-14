<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    protected $fillable = ['subject_name', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(Admin::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
    public function scopeOfTeacher($query){
        return $query->where('teacher_id', Teacher::where('account_id', Auth::user()->id)->first()->id);
    }
}
