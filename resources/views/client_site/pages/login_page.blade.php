@extends('client_site.layouts.main')

@section('title', 'Login')

@section('content')
    <section class="banner banner3 bg-full overlay"
        style="background-image: url({{ asset('assets/backoffice/img/photos/unsplash-1.jpg') }});">
        <div class="holder">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>Login</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="twocolumns pad-top-lg pad-bottom-lg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <!-- Login holder of the page -->
                    <div class="register-holder">
                        <div class="txt-holder">
                            <h3 class="heading2">Login Now</h3>
                            <p>Fill the forum to confirm your registration</p>
                            <form action="{{ route('client.login') }}" method="POST" class="register-form">
                                @csrf
                                <fieldset>
                                    <input type="email" class="form-control" placeholder="Email Address *" name="email"
                                        style="text-transform: lowercase;">
                                    <input type="password" class="form-control" placeholder="Password *" name="password">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember">Remember Me
                                    </div>
                                    @error('general')
                                        <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <button type="submit" class="btn-primary text-center text-uppercase">Login
                                        Now</button>
                                </fieldset>
                            </form>
                            <div class="btn-holder">

                                <p> Vous n'avez pas de compte ? <a href="{{ route('client.register_page') }}"
                                        class="clr">Cliquez ici</p>
                                <a href="#" class="google-btn"><i class="fa fa-google-plus"></i> Sign in with
                                    Google</a>
                                <a href="#" class="fb-btn"><i class="fa fa-facebook"></i> Sign in with Facebook</a>
                            </div>
                        </div>
                        <div class="img-holder">
                            <img src="{{ asset('assets/backoffice/img/photos/unsplash-2.jpg') }}" alt="login"
                                class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
