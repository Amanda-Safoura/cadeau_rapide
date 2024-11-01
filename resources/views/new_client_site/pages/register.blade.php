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


    <title>Cadeau Rapide | S'incrire</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
</head>

<body>
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
                            <a href="{{route('client.home')}}"><img src="{{ asset('assets/LOGO CADEAURAPIDE-512x512.png') }}" alt="logo CADEAURAPIDE"></a>
                        </div>
                        <div class="tab user-tab">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 col-md-12">
                                    <ul class="tabs">
                                        <li class="current">
                                            <a href="javascript:void(0);"> <i class="flaticon-verify"></i> Register</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="tab_content current active">
                                        <div class="tabs_item">
                                            <div class="user-all-form">
                                                <div class="contact-form">
                                                    <form id="contactForm" action="{{ route('client.register') }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-12 ">
                                                                <div class="form-group">
                                                                    <i class='bx bx-user'></i>
                                                                    <input type="text" name="name" id="name"
                                                                        class="form-control"
                                                                        data-error="Please enter your Username"
                                                                        placeholder="Username">
                                                                </div>
                                                                @error('name')
                                                                    <div class="alert alert-danger" role="alert">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <i class='flaticon-email-2'></i>
                                                                    <input type="text" name="email" id="email"
                                                                        class="form-control" required
                                                                        data-error="Please enter email"
                                                                        placeholder="Email">
                                                                </div>
                                                                @error('email')
                                                                    <div class="alert alert-danger" role="alert">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <i class='bx bx-lock-alt'></i>
                                                                    <input class="form-control" type="password"
                                                                        name="password" placeholder="Password">
                                                                </div>
                                                                @error('password')
                                                                    <div class="alert alert-danger" role="alert">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <i class='bx bx-lock-alt'></i>
                                                                    <input class="form-control" type="password"
                                                                        name="password_confirmation"
                                                                        placeholder="Password">
                                                                </div>
                                                                @error('password_confirmation')
                                                                    <div class="alert alert-danger" role="alert">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-lg-12 col-md-12 text-center">
                                                                <button type="submit"
                                                                    class="default-btn  user-all-btn">
                                                                    S'inscrire
                                                                </button>
                                                            </div>

                                                            <div class="col-12">
                                                                <p class="account-desc">
                                                                    Vous avez déjà un compte?
                                                                    <a
                                                                        href="{{ route('client.login_page') }}">Connectez</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="social-option">
                                                        <h3>Ou S'inscrire avec</h3>
                                                        <ul>
                                                            <li><a href="#">Facebook</a></li>
                                                            <li><a href="#">Google</a></li>
                                                        </ul>
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
    </div>

    <!-- Jquery Min JS -->
    <script src="{{ asset('assets/new_client_side/js/jquery.min.js') }}"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="{{ asset('assets/new_client_side/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
