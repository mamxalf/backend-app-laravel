<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    protected $table = 'absents';
    protected $primaryKey = 'id';

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
