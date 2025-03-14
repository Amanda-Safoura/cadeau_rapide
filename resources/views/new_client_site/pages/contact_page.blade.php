@extends('new_client_site.layouts.main')

@section('title', 'Contact')

@section('additionnal_css')
    <style>
        .text-danger {
            color: #eb3535 !important
        }
    </style>
@endsection

@section('content')

    <!-- Inner Banner -->
    <div class="inner-banner inner-bg1">
        <div class="container">
            <div class="inner-title text-center">
                <h3>Nous Contactez</h3>
                <ul>
                    <li>
                        <a href="{{ route('client.home') }}">Accueil</a>
                    </li>
                    <li>
                        <i class='bx bx-chevron-right'></i>
                    </li>
                    <li>Contact</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Contact Area -->
    <div class="contact-area">
        <div class="container">
            <div class="contact-max">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="contact-card">
                            <i class="flaticon-position"></i>
                            <h3>54 Hegmann Uninuo Apt. 890, New</h3>
                            <h3>York, NY 10018, United States.</h3>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="contact-card">
                            <i class="flaticon-email"></i>
                            <h3><a href="mailto:info@downtown.com">Email:info@downtown.com</a></h3>
                            <h3><a href="mailto:support@downtown.com">Email:support@downtown.com</a></h3>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6  ">
                        <div class="contact-card">
                            <i class="flaticon-to-do-list"></i>
                            <h3><a href="tel:+(06)–5432134567">+(06) – 543 213 4567</a></h3>
                            <h3><a href="tel:+(05)–25489073901">+(05) – 254 8907 3901</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Area End -->
    <!-- Map Area Two -->
    <div class="contact-map">
        <div class="container-fluid m-0 p-0">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2033420.4456907373!2d-76.77319039695011!3d5.48885346715773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e442e4d1580d825%3A0xeeedce6524559034!2sRinc%C3%B3n%20del%20Bosque!5e0!3m2!1sen!2sbd!4v1611489832448!5m2!1sen!2sbd"></iframe>
            <div class="contact-wrap">
                <div class="contact-form">
                    <h2>Nous Laisser Un Message</h2>
                    <form action="{{ route('client.user_message.store') }}" method="POST" id="contactForm">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <i class='bx bx-user'></i>
                                    <input type="text" name="name" id="name" 
                                    @auth
                                         value="{{ auth()->user()->name }}"
                                    @endauth class="form-control" required
                                        data-error="Saissisez votre nom" placeholder="Votre nom*">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <i class='bx bx-user'></i>
                                    <input type="email" name="email" id="email" 
                                    @auth
                                         value="{{ auth()->user()->email }}"
                                    @endauth class="form-control" required
                                        data-error="Saissisez votre email" placeholder="E-mail*">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12">
                                <div class="form-group">
                                    <i class='bx bx-file'></i>
                                    <input type="text" name="subject" id="subject" class="form-control" required
                                        data-error="L'objet de ce message" placeholder="L'objet">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <i class='bx bx-envelope'></i>
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="8" required
                                        data-error="Écrivez ici votre message" placeholder="Votre message*"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="default-btn border-radius">
                                    Envoyer le Message
                                </button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Map Area Two End -->

    </section>

@endsection

@section('additionnal_js')

    <!-- JQuery Validate Plugin -->
    <script src="{{ asset('assets/backoffice/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>

    <script>
        // Initialisation de la validation avec jQuery Validate
        $('#contactForm').validate({
            errorClass: "text-danger", // Classe d'erreur pour les messages de validation
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            rules: {
                name: {
                    required: true,
                    minlength: 4,
                    maxlength: 100
                },
                email: {
                    required: true,
                    email: true
                },
                message: {
                    required: true
                },
            },
            messages: {
                name: {
                    required: "Veuillez entrer votre nom.",
                    minlength: "Veuillez entrer un nom de 4 caractères minimum.",
                    maxlength: "Veuillez entrer un nom de 100 caractères maximum."
                },
                email: {
                    required: "Veuillez entrer votre adresse email.",
                    email: "Veuillez entrer une adresse email valide."
                },
                message: "Veuillez svp entrer un message valide."
            }
        });

    </script>
@endsection
