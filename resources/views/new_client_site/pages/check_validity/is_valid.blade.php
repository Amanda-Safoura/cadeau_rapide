@extends('new_client_site.layouts.main')

@section('title', 'Utiliser le chèque cadeau')

@section('additionnal_css')
    <style>
        .card-custom {
            max-width: 100%;
            /* S'adapte à l'écran */
            background: linear-gradient(135deg, #e0f7fa, #ffffff);
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 2rem;
            transition: transform 0.5s ease-in-out;
        }

        .text-success-custom {
            color: #28a745;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .btn-custom {
            background-color: #28a745;
            border-color: #28a745;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-custom:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        /* Form container styling */
        .form-container {
            display: none;
            max-width: 100%;
            /* Utilise 100% de l'écran sur mobile */
            background-color: #f1f1f1;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: opacity 1s ease-out, transform 1s ease-out;
            opacity: 0;
            transform: translateX(50px);
            margin-top: 30px;
            /* Espace entre la carte et le formulaire */
        }

        .form-container.active {
            display: block;
            opacity: 1;
            transform: translateX(0);
        }

        .form-container input {
            margin-bottom: 15px;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-container button {
            background-color: #e7b50a;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #d8a20a;
        }

        /* Container flexbox layout */
        .row-custom {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
        }

        /* Réagir pour les petits écrans */
        @media (max-width: 768px) {

            .card-custom,
            .form-container {
                max-width: 100%;
                /* Assurer que chaque élément prend 100% de la largeur */
                padding: 1.5rem;
                /* Réduire le padding */
            }

            .row-custom {
                flex-direction: column;
                /* Empiler les éléments sur des écrans plus petits */
            }

            .inner-title h3 {
                font-size: 1.5rem;
                /* Adapter la taille de la police */
            }

            .btn-custom {
                font-size: 1rem;
                /* Réduire la taille des boutons */
                padding: 0.8rem 1.5rem;
            }
        }

        @media (max-width: 480px) {

            .card-custom,
            .form-container {
                padding: 1rem;
                /* Moins de padding */
            }

            .inner-title h3 {
                font-size: 1.2rem;
                /* Plus petit sur les petits écrans */
            }

            .btn-custom {
                font-size: 0.9rem;
                padding: 0.6rem 1.2rem;
            }

            .form-container input {
                padding: 8px;
                /* Réduire la taille des champs de texte */
            }
        }
    </style>
@endsection

@section('content')

    <!-- Inner Banner -->
    <div class="inner-banner inner-bg1">
        <div class="container">
            <div class="inner-title text-center">
                <h3>Utiliser le chèque cadeau</h3>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <div class="container d-flex justify-content-center align-items-center my-5 row-custom">
        <div class="card-custom text-center">
            <h2 class="text-success-custom mb-3"> <i class="fas fa-check-circle"></i> Chèque Cadeau Valide !</h2>
            <p class="card-text mb-4 text-secondary">Félicitations ! Votre chèque cadeau est prêt à être utilisé.</p>
            <div class="mt-4">
                <a href="javascript:void(0);" class="btn btn-custom btn-lg px-4" id="debitButton">Comptabiliser ce chèque
                    cadeau</a>
            </div>
        </div>

        <!-- Authentication Form -->
        <div class="form-container" id="authForm">
            <h4 class="mb-3 text-center">Authentification Partenaire</h4>
            <form method="POST" action="{{ route('client.gift_card.do_mark_as_used', ['id' => $gift_card->id]) }}">
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button type="submit">Déclarer comme utilisé</button>
            </form>
        </div>
    </div>

    <!-- Le conteneur de l'alerte modale -->
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertModalLabel">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    {{ session('message') }}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('additionnal_js')
    <script>
        @if (session('message'))
            $(document).ready(function() {
                $('#alertModal').modal('show')
            });
        @endif

        // Show the authentication form when the button is clicked
        $('#debitButton').on('click', function() {
            $('#authForm').addClass('active');
        });
    </script>
@endsection
