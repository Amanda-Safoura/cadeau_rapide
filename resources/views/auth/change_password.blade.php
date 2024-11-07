<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/css/bootstrap.min.css') }}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/fonts/flaticon.css') }}">
    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/css/boxicons.min.css') }}">
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
    <div class="user-area">
        <div class="container-fluid m-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7 col-xl-6  p-0">
                    <div class="user-img">
                        <img src="{{ asset('assets/new_client_side/img/img_cadeau_rapide/img-login-register.jpg') }}" alt="Images">
                    </div>
                </div>

                <div class="col-lg-5 col-xl-6">
                    <div class="user-section text-center">
                        <div class="user-content" style="margin-bottom: 0 !important">
                            <a href="{{ route('client.home') }}"><img
                                    src="{{ asset('assets/LOGO CADEAURAPIDE-512x512.png') }}"
                                    alt="logo CADEAURAPIDE"></a>
                        </div>
                        <div class="tab user-tab">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 col-md-12">
                                    <ul class="tabs">
                                        <li class="current">
                                            <a href="javascript:void(0);"> <i class="flaticon-contact"></i> Mot de
                                                passe</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="tab_content current active">
                                        <div class="tabs_item">
                                            <div class="user-all-form">
                                                <div class="contact-form">
                                                    <!-- Formulaire de mot de passe -->
                                                    <form method="POST" action="{{ route('password.update', ['token' => $token]) }}">
                                                        @csrf
                                                        <div class="row justify-content-center">
                                                            <input type="hidden" name="token"
                                                                value="{{ $token }}">
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
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <i class="bx bx-lock-alt"></i>
                                                                    <input class="form-control" type="password"
                                                                        name="password"
                                                                        placeholder="Veuillez saisir un mot de passe"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                @error('password')
                                                                    <div class="alert alert-danger" role="alert">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <i class="bx bx-lock-alt"></i>
                                                                    <input class="form-control" type="password"
                                                                        name="password_confirmation"
                                                                        placeholder="Entrez le même mot de passe"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                @error('password_confirmation')
                                                                    <div class="alert alert-danger" role="alert">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 text-center">
                                                                <button type="submit"
                                                                    class="default-btn user-all-btn disabled">
                                                                    Réinitialiser le mot de passe
                                                                </button>
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
    </div>
</body>

</html>
