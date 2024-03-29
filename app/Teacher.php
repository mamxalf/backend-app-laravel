<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'id';

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id', 'id');
    }
}
