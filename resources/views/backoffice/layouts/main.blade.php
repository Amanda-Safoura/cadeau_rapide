<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cadeau Rapide &amp; Dashboard">
    <meta name="author" content="Amanda Safoura">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta name="keywords" content="cadeau rapide, chèque, chèque cadeau, bénin, dashboard">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('assets/backoffice/img/icons/icon-48x48.png') }}" />

    <title>@yield('title') | Cadeau Rapide Dashboard</title>

    <link rel="stylesheet" href="{{ asset('assets/backoffice/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/backoffice/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}">

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/backoffice/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Montserrat:300,400,500,600,700", "Lato:300,400,500,600,700", "Public Sans:300,400,500,600,700"]
            },
            custom: {
                "families": ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["{{ asset('assets/backoffice/css/fonts.min.css') }}"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    @yield('additionnal_css')
</head>

<body>
    <div class="wrapper">
        @include('backoffice.partials.sidebar')

        <div class="main">
            @include('backoffice.partials.navbar')

            <main class="content">
                @yield('content')
            </main>

        </div>
    </div>

    <script src="{{ asset('assets/backoffice/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/backoffice/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/backoffice/js/app.js') }}"></script>
    @yield('additionnal_js')

</body>

</html>
