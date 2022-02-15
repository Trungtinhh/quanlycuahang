<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>CÔNG TY TNHH VẬT TƯ THIẾT BỊ Y TẾ VIỆT HẢI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- Plugins css -->
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('assets/css/config/saas/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{asset('assets/css/config/saas/app.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{asset('assets/css/config/saas/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{asset('assets/css/config/saas/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    @yield('css')

</head>

<!-- body start -->

<body class="loading authentication-bg authentication-bg-pattern">

    @yield('content')


    <script src="{{asset('assets/js/vendor.min.js')}}"></script>

    <!-- Plugins js-->
    <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>

    <script src="{{asset('assets/libs/selectize/js/standalone/selectize.min.js')}}"></script>

    <!-- App js-->
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    @yield('script')

</body>

</html>