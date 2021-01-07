@extends('layouts.master')

@section('css')
    <!-- Plugin css -->
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />
    <style>
        .select2 {
            width: 100% !important;
        }

    </style>
@endsection


@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Form Add Student</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Veltrix</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Add New Student</li>
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
                    <form action="{{ route('students.store') }}" method="post">
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="padding-top: 0px;">Select Classroom</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="classroom">
                                    <option>Select Classroom</option>
                                    @foreach ($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">NIS</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="nis" placeholder="Input NIS"
                                    id="example-text-input">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Full Name</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="name" placeholder="Full Name"
                                    id="example-text-input">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="email" placeholder="Email"
                                    id="example-text-input">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="password" name="password" placeholder="Password"
                                    id="example-text-input">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light float-right"><i
                                class="mdi mdi-file-document-box-plus mr-2"></i>Add</button>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

@section('script')
    <!-- Summernote js -->
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/bootstrap-filestyle/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <!-- demo js -->
    <script src="{{ URL::asset('assets/js/pages/form-advanced.init.js') }}"></script>
@endsection
