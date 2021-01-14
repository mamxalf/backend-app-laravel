@extends('layouts.master-without-nav')

@section('title')
    Countdown Absent
@endsection

@section('css')
    <style>
        #qrcode {
            width: 100%;
            height: 100%;
        }

    </style>
@endsection

@section('content')
    <!-- Begin page -->
    <div class="authentication-bg d-flex align-items-center pb-0 vh-100">
        <div class="content-center w-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="home-wrapper text-center">
                            <div class="row justify-content-center">
                                <div class="col-md-12 justify-content-center">
                                    <div class="border border-dark mx-auto" style="width: 400px;">
                                        <h1 id="code" class="my-auto text-dark"> QRCode </h1>
                                    </div>
                                    <div class="w-full">
                                        <div id="qrcode" class="mt-3 mx-auto" style="width: 400px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="home-wrapper text-center">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="border border-dark">
                                        <h1 id="time" class="my-auto text-dark"></h1>
                                    </div>
                                    <table class="table table-sm table-bordered table-striped mt-3">
                                        <thead>
                                            <tr class="font-weight-bold">
                                                <td>No</td>
                                                <td>Nama Siswa</td>
                                                <td>Jam Absent</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Hammam Firdaus</td>
                                                <td>08:00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end col-->
                            </div>
                        </div>
                        <!-- end home wrapper -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
    </div>

@endsection

@section('script')
    <!-- Plugins js-->
    {{-- <script
        src="{{ URL::asset('assets/libs/jquery-countdown/jquery-countdown.min.js') }}"></script>
    --}}

    <!-- Countdown js -->
    <script type="text/javascript">
        function startTimer(duration, display) {
            var timer = duration,
                minutes, seconds;
            setInterval(function() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = duration;
                }
            }, 1000);
        }

        window.onload = function() {
            var fiveMinutes = 60 * 45 * 2,
                display = document.querySelector('#time');
            startTimer(fiveMinutes, display);
        };

    </script>

    <!-- QrCode Js -->
    <script src="{{ URL::asset('assets/js/qrcode.min.js') }}"></script>
    <script>
        new QRCode(document.getElementById("qrcode"), {
            text: "cek",
            width: 400,
            height: 400,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

    </script>

@endsection
