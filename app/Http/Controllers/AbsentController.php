<?php

namespace App\Http\Controllers;

use DateTime;
use App\Absent;
use App\Teacher;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsentController extends Controller
{
    /**
     * Construct.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::with('courses', 'classrooms', 'rooms')->get();

        return view('pages.absents.index')->with([
            'schedules' => $schedules
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $teachers = Teacher::with('users')->get();
        // return view('pages.absents.create')->with([
        //     'teachers' => $teachers
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // function generateRandomString($length = 10) {
        //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //     $charactersLength = strlen($characters);
        //     $randomString = '';
        //     for ($i = 0; $i < $length; $i++) {
        //         $randomString .= $characters[rand(0, $charactersLength - 1)];
        //     }
        //     return $randomString;
        // }

        // $now = new DateTime();
        // $absent = new Absent;
        // $absent->schedule_id = $request->get('schedule');
        // $absent->teacher_id = $request->get('teacher');
        // $absent->start = $now->format('H:i:s');
        // $absent->info = $request->get('info');
        // $absent->token_generate = generateRandomString(5);
        // $absent->save();

        // $request->session()->flash('time', $now->format('H:i:s'));
        // return redirect('/countdown');
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
