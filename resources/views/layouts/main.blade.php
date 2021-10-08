<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BPTWP</title>

        <!-- BEGIN META -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="your,keywords">
        <meta name="description" content="Short explanation about this website">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- END META -->

        <!-- FAVICONS -->
        <link rel="shortcut icon" href="{{ url('/') }}/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="{{ url('/') }}/images/favicon.ico" type="image/x-icon">
        <!-- END FAVICONS -->

        <!-- BEGIN STYLESHEETS -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
        <link type="text/css" rel="stylesheet" href="{{ url('/') }}/materialadmin/css/theme-5/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="{{ url('/') }}/materialadmin/css/theme-5/materialadmin.css" />
        <link type="text/css" rel="stylesheet" href="{{ url('/') }}/materialadmin/css/theme-5/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="{{ url('/') }}/materialadmin/css/theme-5/material-design-iconic-font.min.css" />
        <link type="text/css" rel="stylesheet" href="{{ url('/') }}/materialadmin/css/theme-5/libs/rickshaw/rickshaw.css" />
        <link type="text/css" rel="stylesheet" href="{{ url('/') }}/materialadmin/css/theme-5/libs/morris/morris.core.css" />
        <link type="text/css" rel="stylesheet" href="{{ url('/') }}/css/styles.css" />
        <!-- END STYLESHEETS -->

        @yield('header_script')

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script type="text/javascript" src="{{ url('/') }}/materialadmin/js/libs/utils/html5shiv.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/materialadmin/js/libs/utils/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="menubar-hoverable header-fixed menubar-pin">

        @include('layouts/header')

        <!-- BEGIN BASE-->
        <div id="base">

            <!-- BEGIN CONTENT-->
            <div id="content">
                <section>
                    <div class="section-body">
                        @yield('content')
                    </div><!--end .section-body -->
                </section>
            </div><!--end #content-->
            <!-- END CONTENT -->

            {{-- @include('layouts/nav') --}}

        </div><!--end #base-->
        <!-- END BASE -->

        <!-- BEGIN JAVASCRIPT -->
        <script src="{{ url('/') }}/materialadmin/js/libs/jquery/jquery-1.11.2.min.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/bootstrap/bootstrap.min.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/spin.js/spin.min.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/autosize/jquery.autosize.min.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/moment/moment.min.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/flot/jquery.flot.min.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/flot/jquery.flot.time.min.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/flot/jquery.flot.resize.min.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/flot/jquery.flot.orderBars.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/flot/jquery.flot.pie.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/flot/curvedLines.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/jquery-knob/jquery.knob.min.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/sparkline/jquery.sparkline.min.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/d3/d3.min.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/d3/d3.v3.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/libs/rickshaw/rickshaw.min.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/core/source/App.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/core/source/AppNavigation.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/core/source/AppOffcanvas.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/core/source/AppCard.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/core/source/AppForm.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/core/source/AppNavSearch.js"></script>
        <script src="{{ url('/') }}/materialadmin/js/core/source/AppVendor.js"></script>
        <script src="{{ url('/') }}/js/custom.js"></script>
        <!-- END JAVASCRIPT -->

        @yield('footer_script')
    </body>
</html>
