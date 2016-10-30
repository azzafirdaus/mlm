<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>MLM System</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    
    <!--     Fonts and icons     -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" /> -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" />

    <!-- CSS Files -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrapCustom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}">
    <!-- <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" /> -->
    <link href="{{ asset('assets/css/material-kit.css') }}" rel="stylesheet"/>

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('assets/css/demo.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/stylesheet.css') }}" rel="stylesheet" />

</head>

    @yield('content')

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/material.min.js') }}"></script>

    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('assets/js/nouislider.min.js') }}" type="text/javascript"></script>

    <!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
    <script src="{{ asset('assets/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>

    <!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
    <script src="{{ asset('assets/plugins/jquery-lazzynumeric/js/autoNumeric.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery-lazzynumeric/js/jquery.lazzynumeric.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery-lazzynumeric/js/jquery.lazzynumeric.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/material-kit.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        $("#jumlah-auto").lazzynumeric({aSep: ",", mDec: "0"});

        $().ready(function(){
            // the body of this function is in assets/material-kit.js
            materialKit.initSliders();
            window_width = $(window).width();

            if (window_width >= 992){
                big_image = $('.wrapper > .header');

                $(window).on('scroll', materialKitDemo.checkScrollForParallax);
            }
        });

    </script>
</html>
