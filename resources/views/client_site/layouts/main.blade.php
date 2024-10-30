<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cadeau Rapide &amp; Dashboard">
    <meta name="author" content="Amanda Safoura">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="cadeau rapide, chèque, chèque cadeau, bénin, dashboard">

    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600%7CPoppins:300,400,500,600,900%7CLily+Script+One"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/client_side/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client_side/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client_side/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client_side/css/icofont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client_side/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client_side/css/colors.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client_side/css/responsive.css') }}">

    <style>
        .login-section li, .login-section a {
            color: rgb(51, 184, 108) !important;
        }

        .login-section li a:hover {
            color: rgb(231, 181, 10) !important;
        }
    </style>

    <title>Cadeau Rapide | @yield('title')</title>

    @yield('additionnal_css')
</head>

<body>
    <!-- main container of all the page elements -->
    <div id="wrapper">
        <!-- header of the page -->
        @include('client_site.partials.header')
        <!-- header of the page end -->

        <!-- main of the page -->
        <main id="main">
            @yield('content')
        </main>
        <!-- main of the page end -->

        <!-- footer of the page -->
        @include('client_site.partials.footer')
        <!-- footer of the page end -->

        <span id="back-top" class="text-center md-round fa fa-angle-up"></span>

        <!-- loader of the page -->
        <div id="loader" class="loader-holder">
            <div class="block"><img src="{{ asset('assets/client_side/images/svg/bars.svg') }}" width="60"
                    alt="loader"></div>
        </div>
    </div>
    <!-- main container of all the page elements end -->
    <script src="{{ asset('assets/client_side/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/client_side/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/client_side/js/jquery.main.js') }}"></script>

    @yield('additionnal_js')
</body>

</html>
