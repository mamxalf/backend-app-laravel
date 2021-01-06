<?php

namespace App\Http\Controllers;

use App\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
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
        $classrooms = Classroom::all();

        return view('pages.classrooms.index')->with([
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
        return view('pages.classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $classroom = new Classroom;
        $classroom->name = $request->get('classroom');
        $classroom->save();

        $request->session()->flash('status', 'New Classroom has been added !');
        return redirect('/classrooms');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit($classroom)
    {
        $data = Classroom::findOrFail($classroom);

        return view('pages.classrooms.edit')->with([
            'classroom' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $classroom)
    {
        $data = Classroom::findOrFail($classroom);
        $data->name = $request->get('classroom');
        $data->save();

        $request->session()->flash('status', 'Classroom has been updated !');
        return redirect('/classrooms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$classroom)
    {
        $data = Classroom::findOrFail($classroom);
        $data->delete();

        $request->session()->flash('statusDelete', 'Classroom has been deleted !');
        return redirect('/classrooms');
    }
}
