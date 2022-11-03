
<!doctype html>
<html class="fixed dark">
    <head>

        <!-- Basic -->
        <meta charset="UTF-8">

        <title>@if(array_key_exists('title', $dgr)){{$dgr['title']}} @endif
            {{Auth::user()->name}}</title>
        <meta name="description" content="@if(array_key_exists('descripcion', $dgr)){{$dgr['descripcion']}} @endif">
        <meta name="author" content="okler.net">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="{{ asset('porto-admin/vendor/bootstrap/css/bootstrap.css') }}" />
        <link rel="stylesheet" href="{{ asset('porto-admin/vendor/animate/animate.css') }}">

        <link rel="stylesheet" href="{{ asset('porto-admin/vendor/font-awesome/css/fontawesome-all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('porto-admin/vendor/magnific-popup/magnific-popup.css') }}" />
        <link rel="stylesheet" href="{{ asset('porto-admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />

        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="{{ asset('porto-admin/vendor/jquery-ui/jquery-ui.css') }}" />
        <link rel="stylesheet" href="{{ asset('porto-admin/vendor/jquery-ui/jquery-ui.theme.css') }}" />
        <link rel="stylesheet" href="{{ asset('porto-admin/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}" />
        <link rel="stylesheet" href="{{ asset('porto-admin/vendor/morris/morris.css') }}" />
        <link rel="stylesheet" href="{{ asset('porto-admin/vendor/codemirror/lib/codemirror.css')}}" />
        <link rel="stylesheet" href="{{ asset('porto-admin/vendor/codemirror/theme/monokai.css')}}" />
        <!-- Theme CSS -->
        <link rel="stylesheet" href="{{ asset('porto-admin/css/theme.css') }}" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="{{ asset('porto-admin/css/skins/default.css') }}" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="{{ asset('porto-admin/css/custom.css') }}">

        <!-- Head Libs -->
        <script src="{{ asset('porto-admin/vendor/modernizr/modernizr.js') }}"></script>




        <link rel="stylesheet" href="{{ asset('porto-admin/vendor/select2/css/select2.css')}}" />
        <link rel="stylesheet" href="{{ asset('porto-admin/vendor/select2-bootstrap-theme/select2-bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('porto-admin/vendor/datatables/media/css/dataTables.bootstrap4.css')}}" />
    

        <!-- Head Libs -->
        <style type="text/css">
            .f-l{float: left;}
        </style>


   



    </head>
    <body>
        <section class="body">

            @include('dgr::layouts.header')

            <div class="inner-wrapper">

                @include('dgr::layouts.nav')

                @yield('content')

            </div>

            <aside id="sidebar-right" class="sidebar-right">
                <div class="nano">
                    <div class="nano-content">
                        <a href="#" class="mobile-close d-md-none">
                            Collapse <i class="fas fa-chevron-right"></i>
                        </a>
            
                        <div class="sidebar-right-wrapper">
            
                            <div class="sidebar-widget widget-calendar">
                                <h6>Monitoreo</h6>

                                {{-- <div data-plugin-datepicker data-plugin-skin="dark"></div> --}}
            
                                {{-- <ul>
                                    <li>
                                        <time datetime="2017-04-19T00:00+00:00">04/19/2017</time>
                                        <span>Company Meeting</span>
                                    </li>
                                </ul> --}}
                            </div>
            
                            {{-- <div class="sidebar-widget widget-friends">
                                <h6>Friends</h6>
                                <ul>
                                    <li class="status-online">
                                        <figure class="profile-picture">
                                            <img src="img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                    <li class="status-online">
                                        <figure class="profile-picture">
                                            <img src="img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                    <li class="status-offline">
                                        <figure class="profile-picture">
                                            <img src="img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                    <li class="status-offline">
                                        <figure class="profile-picture">
                                            <img src="img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                </ul>
                            </div> --}}
            
                        </div>
                    </div>
                </div>
            </aside>

        </section>

        <!-- Vendor -->
        <script src="{{ asset('porto-admin/vendor/jquery/jquery.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/popper/umd/popper.min.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/bootstrap/js/bootstrap.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/common/common.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/nanoscroller/nanoscroller.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/magnific-popup/jquery.magnific-popup.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/jquery-placeholder/jquery-placeholder.js')}}"></script>
        
        <!-- Specific Page Vendor -->
        <script src="{{ asset('porto-admin/vendor/jquery-ui/jquery-ui.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/jquery-appear/jquery-appear.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/flot/jquery.flot.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/flot.tooltip/flot.tooltip.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/flot/jquery.flot.pie.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/flot/jquery.flot.categories.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/flot/jquery.flot.resize.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/jquery-sparkline/jquery-sparkline.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/raphael/raphael.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/morris/morris.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/gauge/gauge.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/snap.svg/snap.svg.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/liquid-meter/liquid.meter.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/jqvmap/jquery.vmap.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/jqvmap/data/jquery.vmap.sampledata.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/jqvmap/maps/jquery.vmap.world.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/jqvmap/maps/continents/jquery.vmap.africa.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/jqvmap/maps/continents/jquery.vmap.asia.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/jqvmap/maps/continents/jquery.vmap.australia.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/jqvmap/maps/continents/jquery.vmap.europe.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/codemirror/lib/codemirror.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/codemirror/addon/selection/active-line.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/codemirror/addon/edit/matchbrackets.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/codemirror/mode/javascript/javascript.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/codemirror/mode/xml/xml.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/codemirror/mode/htmlmixed/htmlmixed.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/codemirror/mode/css/css.js')}}"></script>
        <script src="{{ asset('porto-admin/js/theme.js')}}"></script>
        <script src="{{ asset('porto-admin/js/custom.js')}}"></script>
        <script src="{{ asset('porto-admin/js/theme.init.js')}}"></script>
        <script src="{{ asset('porto-admin/js/examples/examples.dashboard.js')}}"></script>

        <script src="{{ asset('porto-admin/vendor/select2/js/select2.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/datatables/media/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/datatables/media/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js')}}"></script>
        <script src="{{ asset('porto-admin/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js')}}"></script>
        <script src="{{ asset('porto-admin/js/examples/examples.datatables.default.js')}}"></script>
        <script src="{{ asset('porto-admin/js/examples/examples.datatables.row.with.details.js')}}"></script>
        <script src="{{ asset('porto-admin/js/examples/examples.datatables.tabletools.js')}}"></script>

        <script src="{{ asset('porto-admin/vendor/pnotify/pnotify.custom.js')}}"></script>
        <script src="{{ asset('porto-admin/js/examples/examples.modals.js')}}"></script>



        


    </body>
</html>