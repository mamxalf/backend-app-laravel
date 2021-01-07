<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function classrooms()
    {
        return $this->hasOne(Classroom::class, 'id', 'classroom_id');
    }
}
