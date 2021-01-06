<?php

namespace App\Http\Controllers;

use App\Course;
use App\Teacher;
use Illuminate\Http\Request;

class CourseController extends Controller
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
        $courses = Course::with('teachers.users')->get();

        return view('pages.courses.index')->with([
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
        $teachers = Teacher::with('users')->get();
        return view('pages.courses.create')->with([
            'teachers' => $teachers
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
        $course = new Course;
        $course->course_title = $request->get('course');
        $course->teacher_id = $request->get('teacher');
        $course->save();

        $request->session()->flash('status', 'New Course has been added !');
        return redirect('/courses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($course)
    {
        $data = Course::with('teachers.users')->where('id', $course)->first();
        $teachers = Teacher::with('users')->get();

        return view('pages.courses.edit')->with([
            'course' => $data,
            'teachers' => $teachers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course)
    {
        $course = Course::findOrFail($course);
        $course->course_title = $request->get('course');
        $course->teacher_id = $request->get('teacher');
        $course->save();

        $request->session()->flash('status', 'Course has been updated !');
        return redirect('/courses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $course)
    {
        $data = Course::findOrFail($course);
        $data->delete();

        $request->session()->flash('statusDelete', 'Room has been deleted !');
        return redirect('/courses');
    }
}
