@extends('client_site.layouts.main')

@section('title', 'Espace Utilisateur')
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

        /* Styles pour le formulaire de réclamation */
        .form-group {
            margin-bottom: 15px;
            /* Espace entre les champs de formulaire */
        }


        .form-control {
            background-color: #f7f7f7
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
                        <h1>Espace Utilisateur</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="container pad-top-lg pad-bottom-lg">
            <h2 class="text-center">Mes Commandes</h2>
            <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Montant Total</th>
                        <th>Nom du Bénéficiaire</th>
                        <th>Date de Livraison</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $order->total_amount }} XOF</td>
                            <td>{{ $order->is_client_beneficiary ? $order->client_name : $order->beneficiary_name }}
                            </td>
                            <td>{{ $order->delivery_date }}</td>
                            <td>
                                <button class="btn btn-info btn-sm"
                                    onclick="openDetailsModal({{ $order->id }})">Détails</button>
                                <button class="btn btn-warning btn-sm"
                                    onclick="openClaimModal({{ $order->id }})">Réclamation</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>

    <!-- Modal pour afficher les détails de la commande -->
    <div id="detailsModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeDetailsModal()">&times;</span>
            <h4 class="modal-title">Détails de la Commande</h4>
            <p><strong>Montant :</strong> <span id="orderAmount"></span></p>
            <p><strong>Message Personnel :</strong> <span id="personalMessage"></span></p>
            <p><strong>Nom du Client :</strong> <span id="clientName"></span></p>
            <p><strong>Email du Client :</strong> <span id="clientEmail"></span></p>
            <p><strong>Téléphone du Client :</strong> <span id="clientPhone"></span></p>
            <p><strong>Bénéficiaire :</strong> <span id="beneficiaryName"></span></p>
            <p><strong>Email du Bénéficiaire :</strong> <span id="beneficiaryEmail"></span></p>
            <p><strong>Téléphone du Bénéficiaire :</strong> <span id="beneficiaryPhone"></span></p>
            <p><strong>Personnalisé :</strong> <span id="isCustomized"></span></p>
            <p><strong>Frais de Personnalisation :</strong> <span id="customizationFee"></span></p>
            <p><strong>Livraison Nécessaire :</strong> <span id="requiresDelivery"></span></p>
            <p><strong>Adresse de Livraison :</strong> <span id="deliveryAddress"></span></p>
            <p><strong>Date de Livraison :</strong> <span id="deliveryDate"></span></p>
            <p><strong>Montant Total :</strong> <span id="totalAmount"></span></p>
        </div>
    </div>

    <!-- Modal pour faire une réclamation -->
    <div id="claimModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeClaimModal()">&times;</span>
            <h4 class="modal-title">Faire une Réclamation</h4>
            <form id="claimForm" action="{{ route('client.reclamation.store') }}" method="POST">
                @csrf
                <input type="hidden" id="giftCardId" name="gift_card_id" value="">

                <div class="form-group">
                    <label for="claimMessage">Message de Réclamation :</label>
                    <textarea class="form-control" id="claimMessage" name="message" rows="4"
                        placeholder="Décrivez le problème rencontré"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer Réclamation</button>
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
@endsection

@section('additionnal_js')
    <script>
        const CUSTOMER_ORDERS = @js($orders)


        // Fonction pour ouvrir le modal des détails
        function openDetailsModal(orderId) {

            let order = CUSTOMER_ORDERS.find((order) => order.id == orderId)

            document.getElementById('orderAmount').textContent = order.amount + ' XOF';
            document.getElementById('personalMessage').textContent = order.personal_message;
            document.getElementById('clientName').textContent = order.client_name;
            document.getElementById('clientEmail').textContent = order.client_email;
            document.getElementById('clientPhone').textContent = order.client_phone;
            document.getElementById('beneficiaryName').textContent = order.is_client_beneficiary ? order.client_name : order
                .beneficiary_name;
            document.getElementById('beneficiaryEmail').textContent = order.is_client_beneficiary ? order.client_email :
                order
                .beneficiary_email;
            document.getElementById('beneficiaryPhone').textContent = order.is_client_beneficiary ? order.client_phone :
                order
                .beneficiary_phone;
            document.getElementById('isCustomized').textContent = order.is_customized ? 'Oui' : 'Non';
            document.getElementById('customizationFee').textContent = order.customization_fee;
            document.getElementById('requiresDelivery').textContent = order.requires_delivery ? 'Oui' : 'Non';
            document.getElementById('deliveryAddress').textContent = order.delivery_address;
            document.getElementById('deliveryDate').textContent = order.delivery_date;
            document.getElementById('totalAmount').textContent = order.total_amount + ' XOF';

            // Affiche le modal
            document.getElementById('detailsModal').style.display = 'block';
            document.body.style.overflow = 'hidden'; // Empêche le scroll de la page en dehors du modal
        }

        // Fonction pour fermer le modal des détails
        function closeDetailsModal() {
            document.getElementById('detailsModal').style.display = 'none';
            document.body.style.overflow = 'auto'; // Rétablit le scroll de la page
        }

        // Fonction pour ouvrir le modal de réclamation
        function openClaimModal(orderId) {
            document.getElementById('claimModal').style.display = 'block';
            $('#giftCardId').val(orderId)
            document.body.style.overflow = 'hidden'; // Empêche le scroll de la page en dehors du modal
        }

        // Fonction pour fermer le modal de réclamation
        function closeClaimModal() {
            document.getElementById('claimModal').style.display = 'none';
            document.body.style.overflow = 'auto'; // Rétablit le scroll de la page
        }

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
            if (event.target === document.getElementById('detailsModal')) {
                closeDetailsModal();
            }
            if (event.target === document.getElementById('claimModal')) {
                closeClaimModal();
            }
            if (event.target === document.getElementById('responseModal')) {
                closeResponseModal();
            }
        }
    </script>
@endsection
