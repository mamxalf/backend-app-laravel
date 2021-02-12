<?php

namespace App\Http\Controllers;

use stdClass;
use App\User;
use App\Course;
use App\Absent;
use App\Teacher;
use App\Student;
use App\Schedule;
use App\TokenAbsent;
use App\ValidationAbsent;
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

        // teacher id
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $absent->teacher_id = $teacher->id;
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

    public function listCourses()
    {
        $user = User::with('teachers')->where('id', Auth::user()->id)->first();
        // return response()->json($user);
        $teacherID = $user->teachers->id;
        // dd($teacherID);
        $courses = Course::with('teachers.users')->where('teacher_id', $teacherID)->get();

        // return response()->json($courses);
        return view('teacher-dashboard.courses')->with([
            'courses' => $courses
        ]);
    }

    public function updateCourse(Request $request, $id_course)
    {
        $course = Course::findOrFail($id_course);
        $course->course_title = $request->get('course');
        $course->save();

        $request->session()->flash('status', 'Course has been updated !');
        return redirect('/courses-teacher');
    }

    public function viewUpdateCourse($id_course)
    {
        $data = Course::with('teachers.users')->where('id', $id_course)->first();

        return view('teacher-dashboard.update-course')->with([
            'course' => $data
        ]);
    }

    public function showResume()
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        // dd($teacher);
        $resumes = Absent::with('schedule.courses')->where('teacher_id', $teacher->id)->get();

        return view('teacher-dashboard.resume')->with([
            'resumes' => $resumes
        ]);
    }

    public function showSchedule($schedule_id)
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $schedules = Schedule::with('courses')->where('teacher_id', $teacher->id)->get();
        // return response()->json($schedules);
        return view('teacher-dashboard.list')->with([
            'schedules' => $schedules
        ]);
    }

    public function showAbsent($schedule_id)
    {
        $schedule = Schedule::with('courses')->where('id', $schedule_id)->first();
        $userAbsents = ValidationAbsent::where('schedule_id', $schedule_id)->groupBy('student_id')->select('student_id', DB::raw('count(*) as total'))->get();

        $arr = [];

        foreach ($userAbsents as $absent) {
            $student = Student::where('id', $absent->student_id)->with('users')->first();

            $objStudent = new stdClass();
            $objStudent->id = $absent->student_id;
            $objStudent->total = $absent->total;
            $objStudent->data = $student;

            // $data = [
            //     'id' => $absent->student_id,
            //     'total' =>  $absent->total,
            //     'data' => $student,
            // ];

            // $jsonStudent = json_encode($objStudent);

            // return response()->json($data);

            // $arr[] = $data;
            $arr[] = $objStudent;
            // array_push($objStudent, $arr);
        }

        // $arrJson = json_encode($arr);

        // return response()->json($arr);
        return view('teacher-dashboard.list')->with([
            'data' => $arr,
            'schedule' => $schedule
        ]);
    }
}
