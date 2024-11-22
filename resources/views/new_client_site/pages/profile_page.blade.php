@extends('new_client_site.layouts.main')

@section('title', 'Espace Utilisateur')
@section('additionnal_css')
    <style>
        .theme-light .card {
            color: #1e1e1e;
        }

        .theme-dark .card {
            background-color: #1e1e1e;
            color: #f8f9fa;
            border: 1px solid #333;
        }

        .options-card {
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 1rem;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
        }

        .progress-step {
            font-size: 0.9rem;
            font-weight: bold;
        }

        .theme-dark .modal-content {
            background-color: #2c2c2c;
            color: #f8f9fa;
            border: 1px solid #444;
        }

        .theme-dark .modal-header,
        .theme-dark .modal-footer {
            border-color: #444;
        }

        .theme-dark .modal-header .btn-close {
            filter: invert(1);
        }

        .theme-dark .form-control {
            background-color: #3b3b3b;
            color: #f8f9fa;
            border-color: #555;
        }

        .theme-dark .form-control::placeholder {
            color: #bbb;
        }

        .theme-dark .btn-primary {
            background-color: #4674bd;
            border-color: #4a4aff;
        }

        .theme-dark .btn-warning {
            background-color: #e7b50a;
            border-color: #e7b50a;
        }
    </style>
@endsection

@section('content')

    <!-- Inner Banner -->
    <div class="inner-banner inner-bg1">
        <div class="container">
            <div class="inner-banner-title text-center">
                <h3>Espace Utilisateur</h3>
            </div>

        </div>
    </div>
    <!-- Inner Banner End -->

    <div class="profile_area">
        <div class="container my-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card options-card">
                        <h4 class="card-header">Options Utilisateur</h4>
                        <ul class="nav flex-column mt-3">
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link" style="color: #3979e0"
                                    onclick="showSection('orders')">Mes
                                    commandes</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link" style="color: #3979e0"
                                    onclick="showSection('profile')">Mon
                                    profil</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Section de droite pour le profil et les détails dynamiques -->
                <main class="col-md-8">
                    <!-- Profil Utilisateur -->
                    <div class="card p-4 d-none" id="profile-section">
                        <h4 class="card-header">Profil Utilisateur</h4>
                        <form method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Nom d'utilisateur</label>
                                <input type="text" class="form-control" id="username" placeholder="Nom d'utilisateur"
                                    value="{{ auth()->user()->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse e-mail</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" readonly
                                    value="{{ auth()->user()->email }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                        </form>
                    </div>

                    <!-- Section dynamique des commandes et livraisons -->
                    <div id="details-section">
                        <h4 class="mb-3">Mes commandes</h4>
                        @foreach ($orders as $key => $order)
                            <div class="card mb-3 p-3">
                                <div class="d-flex justify-content-between">
                                    <h5><strong>Commande</strong> #{{ $key + 1 }}</h5>
                                    <a href="{{ route('client.gift_card.generatePDF', ['id' => $order->id]) }}"
                                        type="button" class="btn btn-success">Télécharger</a>
                                </div>
                                <p><strong>Montant Total</strong>: {{ $order->total_amount }} XOF</p>
                                <p><strong>Nom du Bénéficiaire</strong>:
                                    {{ $order->is_client_beneficiary ? 'Vous-même' : $order->beneficiary_name }}</p>
                                <p>Date : {{ date_format($order->created_at, 'd F Y') }}</p>
                                @php
                                    $progressClass = 'progress-bar';
                                    $progressWidth = 'width: 0%';
                                    $progressAria = 'aria-valuenow="0"';

                                    if ($order->shipping_status === 'awaiting processing') {
                                        $progressClass .= ' bg-primary';
                                        $progressWidth = 'width: 1%';
                                        $progressAria = 'aria-valuenow="1"';
                                    } elseif ($order->shipping_status === 'pending') {
                                        $progressClass .= ' bg-warning';
                                        $progressWidth = 'width: 33%';
                                        $progressAria = 'aria-valuenow="33"';
                                    } elseif ($order->shipping_status === 'delivered') {
                                        $progressClass .= ' bg-success';
                                        $progressWidth = 'width: 100%';
                                        $progressAria = 'aria-valuenow="100"';
                                    }
                                @endphp

                                <div class="progress mb-2" style="height: 8px;">
                                    <div class="{{ $progressClass }}" role="progressbar" style="{{ $progressWidth }}"
                                        {{ $progressAria }}></div>
                                </div>

                                <div class="d-flex justify-content-between progress-step">
                                    <span>En attente de traitement</span>
                                    <span>En cours</span>
                                    <span>Livrée</span>
                                </div>
                                <button class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal"
                                    data-bs-target="#detailsModal" order_id="{{ $order->id }}">Voir les
                                    détails</button>
                                <button class="btn btn-warning btn-sm mt-2" data-bs-toggle="modal"
                                    data-bs-target="#reclaimModal" order_id="{{ $order->id }}">Réclamer</button>
                            </div>
                        @endforeach
                    </div>
                </main>
            </div>

            <!-- Modal pour Réclamation -->
            <div class="modal fade" id="reclaimModal" tabindex="-1" aria-labelledby="reclaimModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="reclaimModalLabel">Réclamation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="claimForm" action="{{ route('client.reclamation.store') }}" method="POST">
                                @csrf
                                <input type="hidden" id="giftCardId" name="gift_card_id" value="">

                                <div class="form-group">
                                    <label for="claimMessage">Message de Réclamation :</label>
                                    <textarea class="form-control" id="claimMessage" name="message" rows="4"
                                        placeholder="Décrivez le problème rencontré"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Envoyer Réclamation</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Détails de la Commande</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Montant :</strong> <span id="orderAmount"></span></p>
                    <p><strong>Partenaire :</strong> <span id="partnerName"></span></p>
                    <p><strong>Message Personnel :</strong> <span id="personalMessage"></span></p>
                    <p><strong>Nom du Client :</strong> <span id="clientName"></span></p>
                    <p><strong>Email du Client :</strong> <span id="clientEmail"></span></p>
                    <p><strong>Téléphone du Client :</strong> <span id="clientPhone"></span></p>
                    <p><strong>Bénéficiaire :</strong> <span id="beneficiaryName"></span></p>
                    <p><strong>Email du Bénéficiaire :</strong> <span id="beneficiaryEmail"></span></p>
                    <p><strong>Téléphone du Bénéficiaire :</strong> <span id="beneficiaryPhone"></span></p>
                    <p><strong>Personnalisé :</strong> <span id="isCustomized"></span></p>
                    <p><strong>Frais de Personnalisation :</strong> <span id="customizationFee"></span></p>
                    <p><strong>Adresse de Livraison :</strong> <span id="deliveryAddress"></span></p>
                    <p><strong>Zone de Livraison :</strong> <span id="shippingZone"></span></p>
                    <p><strong>Frais de Livraison :</strong> <span id="shippingPrice"></span></p>
                    <p><strong>Numéro de la personne à contacter :</strong> <span id="deliveryContact"></span></p>
                    <p><strong>Date de Livraison :</strong> <span id="deliveryDate"></span></p>
                    <p><strong>Montant Total :</strong> <span id="totalAmount"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additionnal_js')
    <script>
        // Fonction pour afficher la section choisie
        function showSection(section) {
            if (section === 'orders') {
                $('#profile-section').addClass('d-none')
                $('#details-section').removeClass('d-none')

            } else if (section === 'profile') {
                $('#profile-section').removeClass('d-none')
                $('#details-section').addClass('d-none')
            }
        }

        const CUSTOMER_ORDERS = @js($orders)

        // Fonction pour ouvrir le modal des détails
        $('button[data-bs-target="#reclaimModal"]').on('click', function() {
            $('#giftCardId').val($(this).attr('order_id'));
        })


        // Fonction pour ouvrir le modal des détails
        $('button[data-bs-target="#detailsModal"]').on('click', function() {
            let orderId = $(this).attr('order_id')
            let order = CUSTOMER_ORDERS.find((order) => order.id == orderId)

            $('#orderAmount').text(order.amount + ' XOF')
            $('#partnerName').text(order.partner.name)
            $('#personalMessage').text(order.personal_message)
            $('#clientName').text(order.client_name)
            $('#clientEmail').text(order.client_email)
            $('#clientPhone').text(order.client_phone)
            $('#beneficiaryName').text(order.is_client_beneficiary ? order.client_name : order.beneficiary_name)
            $('#beneficiaryEmail').text(order.is_client_beneficiary ? order.client_email : order.beneficiary_email)
            $('#beneficiaryPhone').text(order.is_client_beneficiary ? order.client_phone : order.beneficiary_phone)
            $('#isCustomized').text(order.is_customized ? 'Oui' : 'Non')
            $('#customizationFee').text(order.customization_fee + ' XOF')
            $('#deliveryAddress').text(order.delivery_address)
            $('#shippingZone').text(order.shipping_zone)
            $('#shippingPrice').text(order.shipping_price + ' XOF')
            $('#deliveryContact').text(order.delivery_contact ?? 'Non défini')

            let delivery_date = new Date(order.delivery_date)

            // Options de formatage
            let options = {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            };

            // Formatter la date
            let formattedDate = new Intl.DateTimeFormat('en-GB', options).format(delivery_date);

            $('#deliveryDate').text(formattedDate)
            $('#totalAmount').text(order.total_amount + ' XOF')
        })

    </script>
@endsection
