<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\TokenAbsent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function privateData(Request $request)
    {
        $userID = $request->user()->id;

        $data = User::with('students.classrooms')->where('id', $userID)->first();

        return response()->json($data);
    }

    public function userAbsent(Request $request, $token)
    {
        $valAbsent = TokenAbsent::where('token_generate', $token)->first();
        if ($valAbsent->status == 1) {
            $userAbsent = new TokenAbsent;
            $userAbsent->student_id = Auth::user()->id;
            $userAbsent->token_absent = $token;
            $userAbsent->time_absent = now();
            $userAbsent->save();

            return response()->json([
                'status' => 'Success',
                'messae' => 'Absent berhasil'
            ]);

        } else {
            return response()->json([
                'status' => 'Expired',
                'message' => 'Maaf kode Absent Kadaluarsa'
            ]);
        }
    }
}
