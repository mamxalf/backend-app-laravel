<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Absent;
use App\Schedule;
use App\TokenAbsent;
use App\ValidationAbsent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class AppController extends Controller
{
    public function privateData(Request $request)
    {
        $userID = $request->user()->id;

        $data = User::with('students.classrooms')->where('id', $userID)->first();

        return response()->json($data);
    }

    public function userAbsent(Request $request)
    {
        $token = $request->get('token');

        $valAbsent = TokenAbsent::where('token_generate', $token)->first();
        if (!$valAbsent) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Maaf kode Absent salah !'
            ]);
        }

        $dataAbsent = Absent::with('schedule.courses')->where('token_generate', $valAbsent->token_absent)->first();
        // return response()->json($dataAbsent->schedule->courses->id);
        $is_expired =  $valAbsent->created_at->addMinutes(90);
        $current_time = Carbon::now();
        if ($valAbsent->status == 1 || $current_time <= $is_expired) {
            $userAbsent = new ValidationAbsent;
            $userAbsent->student_id = $request->get('student_id');
            $userAbsent->course_id = $dataAbsent->schedule->courses->id;
            $userAbsent->token_absent =  $token;
            $userAbsent->time_absent = Carbon::now()->toDateTimeString();
            $userAbsent->save();

            return response()->json([
                'status' => 'Success',
                'message' => 'Absent berhasil'
            ]);
        } else {
            return response()->json([
                'status' => 'Expired',
                'message' => 'Maaf kode Absent Kadaluarsa !'
            ]);
        }
    }

    public function totalCourse($classroom_id)
    {
        $schedule = Schedule::where('classroom_id', $classroom_id)->count();
        return response()->json($schedule);
    }

    public function cek()
    {
        return response()->json('OK');
    }
}
