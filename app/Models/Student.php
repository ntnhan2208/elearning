<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'account_id'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function reviews(){
        return $this->belongsToMany(Review::class);
    }

    public function result(){
        return $this->hasOne(Result::class);
    }
}
