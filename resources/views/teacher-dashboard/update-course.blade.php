@extends('layouts.master-teacher')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Form Add Course</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Veltrix</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Add New Course</li>
                </ol>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle waves-effect waves-light" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-settings mr-2"></i> Settings
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('courses-teacher-update', [$course->id]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Course Title</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="course" placeholder="Course Title"
                                    id="example-text-input" value="{{ $course->course_title }}">
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="padding-top: 0px;">Supervising Teacher</label>
                            <div class="col-sm-9">
                                <select class="custom-select" name="teacher">
                                    <option selected="">Select Teacher</option>
                                    @foreach ($teachers as $teacher)
                                    @if ( $course->teachers->users->name == $teacher->users->name )
                                    <option value="{{ $teacher->id }}" selected>{{ $teacher->users->name }}</option>
                                    @else
                                    <option value="{{ $teacher->id }}">{{ $teacher->users->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <button type="submit" class="btn btn-primary waves-effect waves-light float-right"><i
                                class="mdi mdi-file-document-box-plus mr-2"></i>Updated</button>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
@endsection
