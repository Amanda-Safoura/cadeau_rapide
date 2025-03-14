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


    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/favicon/favicon.ico') }}" type="image/x-icon">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}">


    <title>Cadeau Rapide | @yield('title', 'Accueil')</title>

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

        /* Pour les petits écrans (mobile et tablettes jusqu'à 767px) */
        .mt-custom {
            margin-top: 20px;
        }

        /* Pour les écrans medium et plus larges (≥768px) */
        @media (min-width: 768px) {
            .mt-custom {
                margin-top: 240px;
            }
        }

        .category-container {
            display: grid;
            gap: 1rem;
            /* Espace entre les éléments */
        }

        /* 5 éléments par ligne sur les grands écrans */
        @media (min-width: 1200px) {
            .category-container {
                grid-template-columns: repeat(5, 1fr);
            }
        }

        /* 4 éléments par ligne sur les écrans de taille moyenne */
        @media (min-width: 992px) and (max-width: 1199px) {
            .category-container {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        /* 3 éléments par ligne sur les écrans de taille intermédiaire */
        @media (min-width: 768px) and (max-width: 991px) {
            .category-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* 2 éléments par ligne sur les petits écrans */
        @media (min-width: 576px) and (max-width: 767px) {
            .category-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* 1 élément par ligne sur les très petits écrans */
        @media (max-width: 575px) {
            .category-container {
                grid-template-columns: 1fr;
            }
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

    @yield('content')

    @include('new_client_site.partials.notificationModals')


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
    <!-- Custom JS -->
    <script src="{{ asset('assets/new_client_side/js/custom.js') }}"></script>

    @auth
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script>
            function closeAllModals() {
                $('.modal.show').each(function() {
                    const modalInstance = bootstrap.Modal.getInstance(this); // Récupère l'instance Bootstrap
                    if (modalInstance) {
                        modalInstance.hide(); // Ferme le modal
                    }
                });
            }

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = false;

            let pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
                authEndpoint: "{{ env('APP_URL') }}/broadcasting/auth"
            });

            let channel = pusher.subscribe('private-payment-status-updated.{{ auth()->user()->id }}');
            channel.bind('App\\Events\\NewFeexPaymentPayloadEvent', function(data) {
                closeAllModals()

                $('#paymentNotifMessage').html(data['message'])
                $('#paymentNotifModal').modal('show')
            });

            @if (session('message'))
                $(document).ready(function() {
                    $('#alertModal').modal('show')
                });
            @endif
        </script>
    @endauth


    @yield('additionnal_js')
</body>

</html>
