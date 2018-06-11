<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="google-site-verification" content="FW2VvR50fv-Pcydk05cyHGAXc84p0QYawsCdaY6JeYM" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->




    <!-- Bootstrap -->
    <link href="{{url('vendor/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{url('vendor/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{url('vendor/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{url('vendor/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('vendor/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('vendor/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('vendor/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('vendor/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{url('build/css/custom.min.css')}}" rel="stylesheet">

    <link href="{{ url('css/styles.css') }}" rel="stylesheet">

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">

        @include('layouts.nav')

        <!-- page content -->
        <div class="right_col" role="main">
            @yield('content')
        </div>
        <!-- /page content -->

        @include('layouts.footer')


    </div>
</div>

    <!-- jQuery -->
    <script src="{{url('vendor/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{url('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{url('vendor/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{url('vendor/nprogress/nprogress.js')}}"></script>
    <!-- iCheck -->
    <script src="{{url('vendor/iCheck/icheck.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{url('vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('vendor/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{url('vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{url('vendor/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{url('vendor/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('vendor/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{url('vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{url('vendor/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{url('vendor/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{url('vendor/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{url('vendor/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{url('vendor/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{url('vendor/pdfmake/build/vfs_fonts.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{url('build/js/custom.min.js')}}"></script>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
</body>
</html>
