<?php

namespace App\Http\Controllers;

use DateTime;
use App\Absent;
use App\Teacher;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Scheduling\Schedule as CronSchedule;

class AbsentController extends Controller
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

            if(Gate::allows('isAdmin')) return $next($request);
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
        // $schedules = Schedule::with('courses', 'classrooms', 'rooms')->get();
        $resumes = Absent::with('schedule.courses')->get();

        // return response()->json($resumes);

        return view('pages.absents.index')->with([
            'resumes' => $resumes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::with('users')->get();
        return view('pages.absents.create')->with([
            'teachers' => $teachers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CronSchedule $schedule)
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

        $now = now();
        $finish = now()->addMinutes(45);
        $absent = new Absent;
        $absent->schedule_id = $request->get('schedule');
        $absent->teacher_id = $request->get('teacher');
        $absent->start = $now;
        $absent->finish = $finish;
        $absent->info = $request->get('info');
        $absent->token_generate = $tokenAbsentGenerate;
        $absent->save();

        $tokenAbsent = generateRandomString(5);
        $this->tokenAbsentPublic = $tokenAbsent;
        $schedule->call(function () {
            DB::table('tokens_absent')->insert([
                'token_absent' => $this->tokenAbsentGeneratePublic,
                'status' => true,
                'token_generate' => $this->tokenAbsentPublic
            ]);
        })->everyMinute()->between($now, $finish);

        $request->session()->flash('time', $now->format('H:i:s'));
        return redirect('/countdown');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function show(Absent $absent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function edit(Absent $absent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absent $absent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absent $absent)
    {
        //
    }

    public function countdown()
    {
        return view('pages.absents.countdown');
    }
}
