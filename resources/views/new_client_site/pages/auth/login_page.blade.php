@extends('new_client_site.layouts.auth')

@section('title', 'Se connecter')

@section('page_content')
    <div class="col-lg-12 col-md-12">
        <ul class="tabs">
            <li class="current">
                <a href="javascript:void(0);"> <i class="flaticon-contact"></i>
                    Connexion</a>
            </li>
        </ul>
    </div>

    <div class="col-lg-12 col-md-12">
        <div class="tab_content current active">
            <div class="tabs_item">
                <div class="user-all-form">
                    <div class="contact-form">
                        <form id="contactForm" action="{{ route('client.login') }}" method="POST">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-lg-12 ">
                                    <div class="form-group">
                                        <i class="bx bx-user"></i>
                                        <input type="text" name="email" id="email" class="form-control"
                                            required="" data-error="Saisissez votre adresse mail" placeholder="Email">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <i class="bx bx-lock-alt"></i>
                                        <input class="form-control" type="password" name="password"
                                            placeholder="Mot de passe">
                                    </div>
                                </div>
                                <div class="col-12">
                                    @error('general')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-12 col-md-12 text-center">
                                    <button type="submit" class="default-btn user-all-btn disabled">
                                        Connexion
                                    </button>
                                </div>

                                <div class="col-lg-6 col-sm-6 form-condition">
                                    <div class="agree-label">
                                        <input type="checkbox" id="remember" name="remember">
                                        <label for="remember">
                                            Se rappeler de moi
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6">
                                    <a class="forget" href="{{ route('password.request') }}">Mot de passe
                                        oublié?</a>
                                </div>

                                <div class="col-12">
                                    <p class="account-desc">
                                        Vous navez pas encore de compte?
                                        <a href="{{ route('client.register') }}"
                                            class="text-secondary text-decoration-underline">Créez-en
                                            un</a>
                                    </p>
                                </div>

                            </div>
                        </form>
                        <div class="social-option">
                            <h3>Se connecter avec</h3>
                            <ul>
                                <li><a href="javascript:void(0);">Facebook</a></li>
                                <li><a href="javascript:void(0);">Google</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>@endsection
