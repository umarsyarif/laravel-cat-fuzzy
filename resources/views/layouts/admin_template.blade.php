<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title Page-->
    <title>CAT-UAS SMPN 04 Rumbio Jaya | @yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('assets/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('assets/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" media="all">

    {{-- data table --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>

<body class="animsition">

    <!-- MENU SIDEBAR-->
    @include('layouts.partials.sidebar')
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        @include('layouts.partials.navbar')
        <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            @yield('content')
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('assets/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('assets/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{ asset('assets/vendor/wow/wow.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{ asset('assets/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{ asset('assets/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{ asset('assets/js/main.js')}}"></script>

    {{-- data tables --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('assets/js/datatables-simple-demo.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

    @stack('scripts')

</body>

</html>
<!-- end document-->
