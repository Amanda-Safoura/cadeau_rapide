@extends('new_client_site.layouts.auth')

@section('title', 'S\'inscrire')

@section('page_content')
    <div class="col-lg-12 col-md-12">
        <ul class="tabs">
            <li class="current">
                <a href="javascript:void(0);"> <i class="flaticon-verify"></i>
                    Inscription</a>
            </li>
        </ul>
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="tab_content current active">
            <div class="tabs_item">
                <div class="user-all-form">
                    <div class="contact-form">
                        <form id="contactForm" action="{{ route('client.register') }}" method="POST">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-lg-12 ">
                                    <div class="form-group">
                                        <i class='bx bx-user'></i>
                                        <input type="text" name="name" id="name" class="form-control"
                                            data-error="Saisissez votre nom" placeholder="Username">
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
                                        <input type="text" name="email" id="email" class="form-control" required
                                            data-error="Saisissez votre adresse mail" placeholder="Email">
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
                                        <input class="form-control" type="password" name="password"
                                            placeholder="Mot de passe">
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
                                        <input class="form-control" type="password" name="password_confirmation"
                                            placeholder="Confirmer votre mot de passe">
                                    </div>
                                    @error('password_confirmation')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3 mt-2">
                                    <div class="d-flex">
                                        <input type="checkbox" name="agree_policy" required>
                                        <a href="{{ route('client.policy') }}"
                                            class="ms-2 text-secondary text-decoration-underline">
                                            J'accepte les termes et conditions
                                        </a>
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12 text-center">
                                    <button type="submit" class="default-btn  user-all-btn">
                                        S'inscrire
                                    </button>
                                </div>

                                <div class="col-12">
                                    <p class="account-desc">
                                        Vous avez déjà un compte?
                                        <a href="{{ route('client.login_page') }}"
                                            class="text-secondary text-decoration-underline">Connectez-vous</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                        <div class="social-option">
                            <h3>Ou S'inscrire avec</h3>
                            <ul>
                                <li><a href="javascript:void(0);">Facebook</a></li>
                                <li><a href="javascript:void(0);">Google</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
