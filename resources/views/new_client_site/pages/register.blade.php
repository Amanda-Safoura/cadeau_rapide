@extends('new_client_site.layouts.main')

@section('title', 'Register')

@section('content')
    <section class="banner banner3 bg-full overlay"
        style="background-image: url({{ asset('assets/backoffice/img/photos/unsplash-1.jpg') }});">
        <div class="holder">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>Register</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="twocolumns pad-top-lg pad-bottom-lg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <!-- Register holder of the page -->
                    <div class="register-holder">
                        <div class="txt-holder">
                            <h3 class="heading2">Register Now</h3>
                            <p>Fill the forum to confirm your registration</p>
                            <form action="{{ route('client.register') }}" method="POST" class="register-form">
                                @csrf
                                <fieldset>
                                    <input type="text" class="form-control" required placeholder="Your Name *"
                                        name="name">
                                    @error('name')
                                        <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <input type="email" class="form-control" required placeholder="Email Address *"
                                        name="email" style="text-transform: lowercase;">
                                    @error('email')
                                        <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <input type="password" class="form-control" required placeholder="Password *"
                                        name="password">
                                    @error('password')
                                        <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <input type="password" class="form-control" required
                                        placeholder="Password Confirmation *" name="password_confirmation">
                                    @error('password_confirmation')
                                        <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <div class="form-check">
                                        <input type="checkbox" name="terms_conditions" required> Accept <a href="#"
                                            class="clr">Terms and Conditions</a>
                                    </div>
                                    <button type="submit" class="btn-primary text-center text-uppercase">Register
                                        Now</button>
                                </fieldset>
                            </form>
                            <div class="btn-holder">
                                <p> Vous avez déjà un compte ? <a href="{{ route('client.login_page') }}"
                                        class="clr">Cliquez ici</p>
                                <a href="#" class="google-btn"><i class="fa fa-google-plus"></i> Sign in with
                                    Google</a>
                                <a href="#" class="fb-btn"><i class="fa fa-facebook"></i> Sign in with Facebook</a>
                            </div>
                        </div>
                        <div class="img-holder">
                            <img src="{{ asset('assets/backoffice/img/photos/unsplash-2.jpg') }}" alt="registering"
                                class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
