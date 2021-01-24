<?php

namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
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
        $students = Student::with('users')->get();

        // return view('pages.students.index')->with([
        //     'students' => $students
        // ]);

        return response()->json($students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms = Classroom::all();

        return view('pages.students.create')->with([
            'classrooms' => $classrooms
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
        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->role = 'student';
        $user->save();

        $student = new Student;
        $student->user_id = $user->id;
        $student->classroom_id = $request->get('classroom');
        $student->nis = $request->get('nis');
        $student->save();

        $request->session()->flash('status', 'New Student has been added !');
        return redirect('/students');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($student)
    {
        $classrooms = Classroom::all();
        $data = Student::with('users', 'classrooms')->where('id', $student)->first();

        // return response()->json($data);
        return view('pages.students.edit')->with([
            'student' => $data,
            'classrooms' => $classrooms
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $student)
    {
        $student = Student::findOrFail($student);
        $student->nis = $request->get('nis');
        $student->save();

        $user = User::where('id', $student->user_id)->first();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->save();

        $request->session()->flash('status', 'student has been updated !');
        return redirect('/students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $student)
    {
        $datastudent = Student::findOrFail($student);
        $dataUser =  User::where('id', $datastudent->user_id)->first();
        $datastudent->delete();
        $dataUser->delete();

        $request->session()->flash('statusDelete', 'student has been deleted !');
        return redirect('/students');
    }
}
