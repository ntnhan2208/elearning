<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Test extends Model
{
    use HasFactory;
    protected $table = 'tests';

    protected $fillable = [
        'test_name',
        'teacher_id',
        'chapter_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(Admin::class);
    }

    public function reviews(){
        return $this->belongsToMany(Review::class);
    }

    public function scopeOfTeacher($query){
        return $query->where('teacher_id', Teacher::where('account_id', Auth::user()->id)->first()->id);
    }
}
