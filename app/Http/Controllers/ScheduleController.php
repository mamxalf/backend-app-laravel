<?php

namespace App\Http\Controllers;

use App\Room;
use App\Course;
use App\Schedule;
use App\Classroom;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::with('courses', 'classrooms', 'rooms')->get();

        return view('pages.schedules.index')->with([
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
        $courses = Course::all();
        $classrooms = Classroom::all();
        $rooms = Room::all();

        return view('pages.schedules.create')->with([
            'courses' => $courses,
            'classrooms' => $classrooms,
            'rooms' => $rooms
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schedule = new Schedule;
        $schedule->course_id = $request->get('course');
        $schedule->classroom_id = $request->get('classroom');
        $schedule->room_id = $request->get('room');
        $schedule->day = $request->get('day');
        $schedule->schedule_start = $request->get('start');
        $schedule->schedule_finish = $request->get('finish');
        $schedule->save();

        $request->session()->flash('status', 'New Schedule has been added !');
        return redirect('/schedules');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit($schedule)
    {
        // $schedule = Schedule::findOrFail($schedule);
        $schedule = Schedule::with('courses', 'classrooms', 'rooms')->where('id', $schedule)->first();

        // return response()->json($schedule);
        return view('pages.schedules.edit')->with([
            'schedule' => $schedule
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $schedule)
    {
        $data = Schedule::findOrFail($schedule);
        $data->day = $request->get('day');
        $data->schedule_start = $request->get('start');
        $data->schedule_finish = $request->get('finish');
        $data->save();

        $request->session()->flash('status', 'Schedule has been updated !');
        return redirect('/schedules');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $schedule)
    {
        $data = Schedule::findOrFail($schedule);
        $data->delete();

        $request->session()->flash('statusDelete', 'Schedule has been deleted !');
        return redirect('/schedules');
    }
}
