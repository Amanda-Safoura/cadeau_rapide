<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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


    <title>Cadeau Rapide | Enregistrer un nouveau mot de passe</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
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

    <div class="user-area">
        <div class="container-fluid m-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7 col-xl-6  p-0">
                    <div class="user-img">
                        <img src="{{ asset('assets/new_client_side/img/login-img.jpg') }}" alt="Images">
                    </div>
                </div>

                <div class="col-lg-5 col-xl-6">
                    <div class="user-section text-center">
                        <div class="user-content" style="margin-bottom: 0 !important">
                            <a href="{{ route('client.home') }}"><img
                                    src="{{ asset('assets/LOGO CADEAURAPIDE-512x512.png') }}" alt="logo CADEAURAPIDE">
                            </a>
                        </div>
                        <div class="tab user-tab">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 col-md-12">
                                    <ul class="tabs">
                                        <li class="current">
                                            <a href="javascript:void(0);"> <i class="flaticon-contact"></i>
                                                Réinitialisation du mot de passe</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="tab_content current active">
                                        <div class="tabs_item">
                                            <div class="user-all-form">
                                                <div class="contact-form">
                                                    <!-- Formulaire de mot de passe -->
                                                    <form method="POST" action="{{ route('password.email') }}">
                                                        @csrf
                                                        <div class="row justify-content-center">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <i class="bx bx-user"></i>
                                                                    <input class="form-control" type="email"
                                                                        name="email" placeholder="Adresse mail"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            @error('email')
                                                                <div class="alert alert-danger">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <div class="col-lg-12 col-md-12 text-center">
                                                                <button type="submit"
                                                                    class="default-btn user-all-btn disabled">
                                                                    Envoyer le lien de réinitialisation
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Structure -->
        <div id="statusModal" class="modal" style="display: none;">
            <div class="modal-content">
                <h4>Notification</h4>
                <p>{{ session('status') }}</p>
            </div>
            <div class="modal-footer">
                <button id="closeModal" class="modal-close btn">Fermer</button>
            </div>
        </div>

    </div>

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

    <script>
        $(document).ready(function() {
            // Vérifie si le message de session 'status' est présent
            @if (session('status'))
                // Affiche le modal en cas de message de statut
                $('#statusModal').show();
            @endif

            // Ferme le modal lorsque le bouton de fermeture est cliqué
            $('#closeModal').on('click', function() {
                $('#statusModal').hide();
            });
        });
    </script>

</body>

</html>
