<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cadeau Rapide &amp; Dashboard">
    <meta name="author" content="Special Touch">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="cadeau rapide, chèque, chèque cadeau, bénin, dashboard">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/css/bootstrap.min.css') }}">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/css/owl.theme.default.min.css') }}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/fonts/flaticon.css') }}">
    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/css/boxicons.min.css') }}">
    <!-- Magnific-Popup CSS -->
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/css/magnific-popup.css') }}">
    <!-- Animate Min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/css/animate.min.css') }}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/css/meanmenu.css') }}">
    <!-- Jquery Ui CSS -->
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/css/jquery-ui.css') }}">
    <!-- Nice-Select CSS -->
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/css/nice-select.min.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/css/responsive.css') }}">
    <!-- Theme Dark CSS -->
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/css/theme-dark.css') }}">

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/backoffice/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
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

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Cadeau Rapide | @yield('title', 'Home')</title>

    <style>
        /* Style personnalisé pour une chip grise */
        .chip {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
            color: #333;
            background-color: #e0e0e0;
            border-radius: 50px;
        }
    </style>
    @yield('additionnal_css')
</head>

<body>
    <!-- Pre Loader -->
    <div class="preloader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="spinner"></div>
            </div>
        </div>
    </div>
    <!-- End Pre Loader -->

    <!-- Start Navbar Area -->
    @include('new_client_site.partials.header')
    <!-- End Navbar Area -->

    <!-- Search Overlay -->
    <div class="search-overlay">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="search-layer"></div>
                <div class="search-layer"></div>
                <div class="search-layer"></div>

                <div class="search-close">
                    <span class="search-close-line"></span>
                    <span class="search-close-line"></span>
                </div>

                <div class="search-form">
                    <form action="{{ route('client.partner.search') }}" method="get">
                        @csrf
                        <input name="search" type="text" class="input-search" placeholder="Mot-Clé . . .">
                        <button type="submit"><i class="flaticon-loupe"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search Overlay -->

    @yield('content')

    <!-- Footer Area -->
    @include('new_client_site.partials.footer')
    <!-- Footer Area End -->


    <!-- Jquery Min JS -->
    <script src="{{ asset('assets/new_client_side/js/jquery.min.js') }}"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="{{ asset('assets/new_client_side/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Owl Carousel Min JS -->
    <script src="{{ asset('assets/new_client_side/js/owl.carousel.min.js') }}"></script>
    <!-- Magnific Popup Min JS -->
    <script src="{{ asset('assets/new_client_side/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Wow Min JS -->
    <script src="{{ asset('assets/new_client_side/js/wow.min.js') }}"></script>
    <!-- Jquery Ui JS -->
    <script src="{{ asset('assets/new_client_side/js/jquery-ui.js') }}"></script>
    <!-- Meanmenu JS -->
    <script src="{{ asset('assets/new_client_side/js/meanmenu.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('assets/new_client_side/js/jquery.nice-select.min.js') }}"></script>
    <!-- Ajaxchimp Min JS -->
    <script src="{{ asset('assets/new_client_side/js/jquery.ajaxchimp.min.js') }}"></script>
    <!-- Form Validator Min JS -->
    <script src="{{ asset('assets/new_client_side/js/form-validator.min.js') }}"></script>
    <!-- Contact Form JS -->
    <script src="{{ asset('assets/new_client_side/js/contact-form-script.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/new_client_side/js/custom.js') }}"></script>

    @yield('additionnal_js')
</body>

</html>
