<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'image', 'gender', 'role', 'personal_id'
    ];

    protected $hidden = [
        'password', 'remember_token', 'secret_code'
    ];


    public function setPasswordAttribute($password)
    {
        if ($password !== null && $password !== '')
            $this->attributes['password'] = bcrypt($password);
    }

    public function scopeIsAdmin($query)
    {
        $query->where('role', '1');
    }

    public function scopeIsTeacher($query)
    {
        $query->where('role', '2');
    }

    public function scopeIsStudent($query)
    {
        $query->where('role', '3');
    }

}
