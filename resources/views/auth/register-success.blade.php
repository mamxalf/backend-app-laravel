@extends('layouts.master-without-nav')

@section('title')
    Register Participants Success
@endsection
<div class="authentication-bg d-flex align-items-center pb-0 vh-100">
    <div class="content-center w-100">
        <div class="container">
            <div class="card mo-mt-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-4 ml-auto">
                            <div class="ex-page-content">
                                <h1 class="text-dark display-4 mt-4">Success!</h1>
                                <h4 class="mb-4">your account has been created, please login via the application
                                    provided.</h4>
                                <p class="mb-5">If an error, Please contact the admin <br> Thank.</p>
                                {{-- <a class="btn btn-primary mb-5 waves-effect waves-light" href="/"><i
                                        class="mdi mdi-home"></i> Back to Dashboard</a> --}}
                            </div>

                        </div>
                        <div class="col-lg-5 mx-auto">
                            <img src={{ asset('assets/images/success.png') }} alt=""
                                class="img-fluid mx-auto d-block">
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end container -->
    </div>

</div>
@section('content')


@endsection
