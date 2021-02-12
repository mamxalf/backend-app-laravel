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
                <h4><span class="font-weight-light">Data Absent : </span> {{ $schedule->courses->course_title }}</h4>
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
                        <a class="dropdown-item" href="{{ route('schedules.create') }}">Add New Schedule</a>
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
                    @if ($message = Session::get('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {{ $message }}
                        </div>
                    @endif

                    @if ($message = Session::get('statusDelete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {{ $message }}
                        </div>
                    @endif

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>User ID</th>
                                <th>Student Name</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $key => $d)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->data->users->name }}</td>
                                    <td>{{ $d->total }}</td>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous"></script>
@endsection
