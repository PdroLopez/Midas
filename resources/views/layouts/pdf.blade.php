<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link href="{{ asset('metronic/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/tether/dist/css/tether.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/select2/dist/css/select2.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/nouislider/distribute/nouislider.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/animate.css/animate.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/morris.js/morris.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('metronic/assets/vendors/general/sweetalert2/dist/sweetalert2.css') }}" rel="stylesheet" type="text/css"/>
        <style type="text/css">
            @include('layouts.css-pdf')
        </style>
    </head>
    <body style="background-color: #fff">
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-10">
                @yield('content')
            </div>
            <div class="col-md-1">
            </div>
        </div>
    </body>
</html>
