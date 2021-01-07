<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';
    protected $primaryKey = 'id';

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function classrooms()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id', 'id');
    }

    public function rooms()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
}
