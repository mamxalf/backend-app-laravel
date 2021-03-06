<?php

namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterParticipants;

class RegisterParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::all();
        return view('auth.register-participants')->with([
            'classrooms' => $classrooms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newUser = new User;
        $newStudent = new Student;

        $newUser->name = $request->get('name');
        $newUser->email = $request->get('email');
        $newUser->password = Hash::make($request->get('password'));
        $newUser->role = 'student';
        $newUser->save();

        $newStudent->user_id = $newUser->id;
        $newStudent->classroom_id = $request->get('classroom');
        $newStudent->nis = Hash::make($newUser->email, [
            'memory' => 1024,
            'time' => 2,
            'threads' => 2,
        ]);
        $newStudent->save();
        // dd($newStudent->nis);

        return redirect("/register/participants/success/$newUser->email");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        return view('auth.register-success')->with([
            'email' => $email
        ]);
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
}
