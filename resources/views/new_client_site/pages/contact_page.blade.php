@extends('new_client_site.layouts.main')

@section('title', 'Contact')

@section('additionnal_css')
    <style>
        /* Styles pour le modal personnalisé */
        .modal {
            display: none;
            /* Caché par défaut */
            position: fixed;
            /* Reste en place */
            z-index: 1000;
            /* Au-dessus des autres éléments */
            left: 0;
            top: 0;
            width: 100%;
            /* Pleine largeur */
            height: 100%;
            /* Pleine hauteur */
            overflow: hidden;
            /* Masque le scroll */
            background-color: rgba(0, 0, 0, 0.6);
            /* Fond noir transparent */
        }

        .modal-content {
            background-color: #fefefe;
            border-radius: 8px;
            /* Coins arrondis */
            padding: 20px;
            margin: auto;
            /* Centrer le modal */
            width: 90%;
            /* Largeur relative */
            max-width: 600px;
            /* Largeur maximum */
            max-height: 90vh;
            /* Hauteur maximale pour permettre le scroll */
            overflow-y: auto;
            /* Activer le scroll vertical */
            position: absolute;
            /* Positionnement absolu */
            left: 50%;
            /* Centrer horizontalement */
            top: 50%;
            /* Centrer verticalement */
            transform: translate(-50%, -50%);
            /* Centrer verticalement et horizontalement */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            /* Ombre autour du modal */
        }


        .modal-header {
            border-bottom: none;
            /* Enlever la bordure du header */
            margin-bottom: 15px;
            /* Espace entre le header et le contenu */
        }

        .modal-title {
            margin-bottom: 15px;
            /* Pas de marge par défaut */
            font-weight: bold;
            /* Titre en gras */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

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
                <h3>Contact Us</h3>
                <ul>
                    <li>
                        <a href="{{ route('client.home') }}">Home</a>
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
                    <span>SEND MESSAGE</span>
                    <h2>Contact With Us</h2>
                    <form action="{{ route('client.user_message.store') }}" method="POST" id="contactForm">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <i class='bx bx-user'></i>
                                    <input type="text" name="name" id="name" value="{{auth()->user()->name}}" class="form-control" required
                                        data-error="Please enter your name" placeholder="Your Name*">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <i class='bx bx-user'></i>
                                    <input type="email" name="email" id="email" value="{{auth()->user()->email}}" class="form-control" required
                                        data-error="Please enter your email" placeholder="E-mail*">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12">
                                <div class="form-group">
                                    <i class='bx bx-file'></i>
                                    <input type="text" name="msg_subject" id="subject" class="form-control" required
                                        data-error="Please enter your subject" placeholder="Your Subject">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <i class='bx bx-envelope'></i>
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="8" required
                                        data-error="Write your message" placeholder="Your Message*"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="default-btn border-radius">
                                    Send Message
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

    <!-- Modal pour afficher la réponse du serveur -->
    <div id="responseModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeResponseModal()">&times;</span>
            <h4 class="modal-title">
                {{ session('message') }}
            </h4>
        </div>
    </div>
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


        // Fonction pour ouvrir le modal de réclamation
        function openResponseModal() {
            document.getElementById('responseModal').style.display = 'block';
            document.body.style.overflow = 'hidden'; // Empêche le scroll de la page en dehors du modal
        }

        @if (session('message'))
            openResponseModal()
        @endif

        // Fonction pour fermer le modal de réclamation
        function closeResponseModal() {
            document.getElementById('responseModal').style.display = 'none';
            document.body.style.overflow = 'auto'; // Rétablit le scroll de la page
        }

        // Fermer le modal en cliquant en dehors de celui-ci
        window.onclick = function(event) {
            if (event.target === document.getElementById('responseModal')) {
                closeResponseModal();
            }
        }
    </script>
@endsection
