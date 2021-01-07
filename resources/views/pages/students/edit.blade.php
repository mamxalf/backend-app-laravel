@extends('layouts.master')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Form Update Student</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Veltrix</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Update Student</li>
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
                    <form action="{{ route('students.update', [$student->id]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">NIS</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="nis" value="{{ $student->nis }}" placeholder="Input NIS"
                                    id="example-text-input">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="padding-top: 0px;">Select Classroom</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="classroom">
                                    <option>Select Classroom</option>
                                    @foreach ($classrooms as $classroom)
                                        @if ($student->classrooms->id == $classroom->id)
                                        <option value="{{ $classroom->id }}" selected>{{ $classroom->name }}</option>
                                        @else
                                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Full Name</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="name" value="{{ $student->users->name }}" placeholder="Full Name"
                                    id="example-text-input">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="email" value="{{ $student->users->email }}" placeholder="Email"
                                    id="example-text-input">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light float-right"><i
                                class="mdi mdi-file-document-box-plus mr-2"></i>Update</button>
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
