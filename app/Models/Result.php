<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $table = 'results';
    protected $fillable = ['answer','score','teacher_id','student_id','test_id'];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function test(){
        return $this->belongsTo(Test::class);
    }


}
