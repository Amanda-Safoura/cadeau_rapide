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

    <section class="banner banner3 bg-full overlay"
        style="background-image: url({{ asset('assets/backoffice/img/photos/unsplash-1.jpg') }});">
        <div class="holder">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>Contact</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-sec container pad-top-lg pad-bottom-lg">
        <div class="row">
            <header class="col-xs-12 header text-center">
                <h3 class="heading">Vous êtes libre de nous laisser un message</h3>
                <p>Get in touch with our coupay team</p>
            </header>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <!-- contact list of the page -->
                <ul class="list-unstyled contact-list">
                    <li>
                        <span class="icon icon-location"></span>
                        <div class="align-left">
                            <strong class="title">Our Location</strong>
                            <address>No:50%, Coupmy Street, Sydney, Australia</address>
                        </div>
                    </li>
                    <li>
                        <span class="icon icon-phone"></span>
                        <div class="align-left">
                            <strong class="title">Call Us</strong>
                            <span class="tel"><a href="tel:008528529966">+(00) 852 852 9966</a><a
                                    href="tel:008528529955">+(00) 852 852 9955</a></span>
                        </div>
                    </li>
                    <li>
                        <span class="icon icon-email"></span>
                        <div class="align-left">
                            <strong class="title">Email Address</strong>
                            <span class="mail"><a href="mailto:Info@Coupay.com">Info@Coupay.com</a><a
                                    href="mailto:Mail@Coupay.com">Mail@Coupay.com</a></span>
                        </div>
                    </li>
                </ul>
                <!-- contact form of the page -->
                <form action="{{ route('client.user_message.store') }}" method="POST" class="contact-form"
                    id="contactForm">
                    @csrf
                    <fieldset>
                        <div class="form-group">
                            <div class="col">
                                <label for="name">Nom <span class="clr">*</span></label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                            <div class="col">
                                <label for="email">Adresse Email <span class="clr">*</span></label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col" style="width: 100%">
                                <label for="sub">Objet</label>
                                <input type="text" id="sub" name="subject" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="msg">Votre Message <span class="clr">*</span></label>
                            <textarea name="message" id="msg" name="message"></textarea>
                        </div>
                        <button type="submit" class="btn-primary text-uppercase text-center">Envoyer</button>
                    </fieldset>
                </form>
            </div>
        </div>

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
