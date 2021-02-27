<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValidationAbsent extends Model
{
    protected $table = 'validations_absent';
    protected $primaryKey = 'id';

    public function tokenAbsent()
    {
        return $this->belongsTo(TokenAbsent::class, 'token_absent', 'token_generate');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
