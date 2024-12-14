<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';

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
        return $this->hasOne(Classes::class);
    }

    public function chapters()
    {
        return $this->hasOne(Chapter::class);
    }

}
