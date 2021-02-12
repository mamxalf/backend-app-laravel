@extends('layouts.master-teacher')

@section('css')
    <!-- datatables css -->
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Data courses</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Veltrix</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                    <li class="breadcrumb-item active">courses</li>
                </ol>
            </div>
        </div>

        {{-- <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle waves-effect waves-light" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-menu mr-2"></i> Menu
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('courses.create') }}">Add New course</a>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Course Title</th>
                                <th>Schedule</th>
                                {{-- <th>Classroom</th>
                                <th>Room Code</th>
                                <th>Day</th>
                                <th>Start</th>
                                <th>Finish</th> --}}
                                {{-- <th>Actions</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($courses as $key => $course)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $course->course_title }}</td>
                                    <td>
                                        <table class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr class="font-weight-bold">
                                                    <td>Classrooms</td>
                                                    <td>Rooms</td>
                                                    <td>Day</td>
                                                    <td>Time Schedule</td>
                                                    <td class="text-center">Action</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($course->schedules as $item)
                                                    <tr>
                                                        <td>{{ $item->classrooms->name }}</td>
                                                        <td>{{ $item->rooms->room_code }}</td>
                                                        <td>{{ $item->day }}</td>
                                                        <td>{{ $item->schedule_start }} - {{ $item->schedule_finish }}</td>
                                                        <td class="text-center">
                                                            <a href="{{ route('form-start', ['id' => $item->id]) }}"
                                                                class="btn btn-sm btn-primary waves-effect waves-light">Start
                                                                Absen</a>
                                                                <a href="{{ route('absent-teacher', [$item->id]) }}"
                                                                    class="btn btn-sm btn-danger waves-effect waves-light">List Absent Student</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                    {{-- <td>
                                        <a href="{{ route('absents.create', ['id' => $course->id]) }}"
                                            class="btn btn-info waves-effect waves-light">Start Absen</a>
                                        <a href="{{ route('courses.edit', [$course->id]) }}"
                                            class="btn btn-warning waves-effect waves-light">Update</a>
                                        <form class="d-inline"
                                            onsubmit="return confirm('Data will be Deleted, Are you sure?')"
                                            action="{{ route('courses.destroy', [$course->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="submit" value="Delete"
                                                class="btn btn-danger waves-effect waves-light">
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

@section('script')

    <!-- Plugins js -->
    <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>

@endsection
