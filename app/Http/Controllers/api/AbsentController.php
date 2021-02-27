<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ValidationAbsent;

class AbsentController extends Controller
{
    public function showStudentAbsent($token)
    {
        $data = ValidationAbsent::with('student.users')->where('token_absent', $token)->get();

        return response()->json($data);
    }
}
