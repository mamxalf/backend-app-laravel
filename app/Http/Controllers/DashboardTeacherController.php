<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Absent;
use App\TokenAbsent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

// Datetime
use DateTime;
use DateTimeZone;
use DateInterval;

class DashboardTeacherController extends Controller
{
    public $tokenAbsentGeneratePublic = '';
    public $tokenAbsentPublic = '';

    /**
     * Construct.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){

            if(Gate::allows('isTeacher')) return $next($request);

            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Auth::user()->id);
        $userID = Auth::user()->id;
        $user = User::with('teachers')->where('id', $userID)->first();
        $courses = Course::with('schedules.classrooms', 'schedules.rooms')->where('teacher_id', $user->teachers->id)->get();
        // $schedules = Schedule::with('courses', 'classrooms', 'rooms')->where('course_id', $courses->id)->get();

        // return response()->json($courses);
        return view('teacher-dashboard.schedules')->with([
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher-dashboard.form-start');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $tokenAbsentGenerate = generateRandomString(7);
        $this->tokenAbsentGeneratePublic = $tokenAbsentGenerate;

        // dd($now);
        $start = new DateTime("now", new DateTimeZone('Asia/Jakarta') );

        $minute = 45;
        $now = new DateTime("now", new DateTimeZone('Asia/Jakarta') );
        $finish = $now->add(new DateInterval('PT' . $minute . 'M'));
        // dd($finish);
        $absent = new Absent;
        $absent->schedule_id = $request->get('schedule');
        $absent->teacher_id = Auth::user()->id;
        $absent->start = $start;
        $absent->finish = $finish;
        $absent->info = $request->get('info');
        $absent->token_generate = $tokenAbsentGenerate;
        $absent->save();

        $tokenAbsent = generateRandomString(5);
        $this->tokenAbsentPublic = $tokenAbsent;

        DB::table('tokens_absent')->insert([
            'token_absent' => $this->tokenAbsentGeneratePublic,
            'status' => true,
            'token_generate' => $this->tokenAbsentPublic
        ]);

        // $request->session()->flash('time', $start->format('H:i:s'));
        return view('teacher-dashboard.countdown')->with([
            'start' => $start->format('H:i:s'),
            'finish' => $finish->format('H:i:s'),
            'token_absent' => $this->tokenAbsentGeneratePublic,
            'token_generate' => $this->tokenAbsentPublic
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dashboard()
    {
        return view('teacher-dashboard.index');
    }

    public function stop(Request $request, $token)
    {
        $data = TokenAbsent::where('token_absent', $token)->first();
        $data->status = 0;
        $data->save();

        return redirect('/dashboard-teacher');
    }
}
