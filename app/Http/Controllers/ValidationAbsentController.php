<?php

namespace App\Http\Controllers;

use App\Student;
use App\ValidationAbsent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class ValidationAbsentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $arrDesign = DesignerFavorite::groupBy('name_designer')->select('name_designer', DB::raw('count(*) as total'))->get();
        $userAbsents = ValidationAbsent::groupBy('student_id')->select('student_id', DB::raw('count(*) as total'))->get();

        $arr = [];

        foreach ($userAbsents as $key => $absent) {
            $student = Student::where('id', $absent->student_id)->with('users')->get();

            // $objStudent = new stdClass();
            // $objStudent->id = $absent->student_id;
            // $objStudent->total = $absent->total;
            // $objStudent->data = $student;

            $data = [
                'id' => $absent->student_id,
                'total' =>  $absent->total,
                'data' => $student
            ];

            // $jsonStudent = json_encode($objStudent);

            // return response()->json($data);

            $arr[] = $data;
        //    $arr[] = $objStudent;
            // array_push($objStudent, $arr);
        }


        return response()->json($arr);
        // return view('pages.user-absent.index')->with([
        //     'totals' => $userAbsents
        // ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ValidationAbsent  $validationAbsent
     * @return \Illuminate\Http\Response
     */
    public function show(ValidationAbsent $validationAbsent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ValidationAbsent  $validationAbsent
     * @return \Illuminate\Http\Response
     */
    public function edit(ValidationAbsent $validationAbsent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ValidationAbsent  $validationAbsent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ValidationAbsent $validationAbsent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ValidationAbsent  $validationAbsent
     * @return \Illuminate\Http\Response
     */
    public function destroy(ValidationAbsent $validationAbsent)
    {
        //
    }
}
