<?php

namespace App\Http\Controllers;

use App\User;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
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
        $teachers = Teacher::with('users')->get();

        return view('pages.teachers.index')->with([
            'teachers' => $teachers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.teachers.create');
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
        $user->role = 'teacher';
        $user->save();

        $teacher = new Teacher;
        $teacher->user_id = $user->id;
        $teacher->nik = $request->get('nik');
        $teacher->save();

        $request->session()->flash('status', 'New Teacher has been added !');
        return redirect('/teachers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($teacher)
    {
        $data = Teacher::with('users')->where('id', $teacher)->first();

        // return response()->json($data);
        return view('pages.teachers.edit')->with([
            'teacher' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $teacher)
    {
        $teacher = Teacher::findOrFail($teacher);
        $teacher->nik = $request->get('nik');
        $teacher->save();

        $user = User::where('id', $teacher->user_id)->first();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->save();

        $request->session()->flash('status', 'Teacher has been updated !');
        return redirect('/teachers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $teacher)
    {
        $dataTeacher = Teacher::findOrFail($teacher);
        $dataUser =  User::where('id', $dataTeacher->user_id)->first();
        $dataTeacher->delete();
        $dataUser->delete();

        $request->session()->flash('statusDelete', 'Teacher has been deleted !');
        return redirect('/teachers');
    }
}
