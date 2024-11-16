@extends('partner_backoffice.layouts.main')
@section('title')
    Débiter un Chèque Cadeau
@endsection

@section('additionnal_css')
    <style>
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .bg-section {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .text-primary {
            color: #4CAF50;
            font-weight: bold;
        }

        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
            border-radius: 5px;
            padding: 12px 30px;
            text-transform: uppercase;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <!-- Section: Informations du chèque-cadeau -->
        <div class="row mb-4">
            <div class="col-12 col-md-8 offset-md-2 bg-section">
                <h2 class="section-title text-center">Détails du Chèque-cadeau</h2>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Nom du Client:</strong> <span
                                class="text-primary">{{ $gift_card->is_client_beneficiary ? $gift_card->client_name : $gift_card->client_name }}</span>
                        </p>
                        <p><strong>Email du Client:</strong> <span
                                class="text-primary">{{ $gift_card->is_client_beneficiary ? $gift_card->client_email : $gift_card->client_email }}</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Montant:</strong> <span
                                class="text-primary">{{ number_format($gift_card->amount, 0, '', ' ') }}
                                XOF</span></p>
                        <p><strong>Message Personnel:</strong> <span
                                class="text-primary">{{ $gift_card->personal_message ?? 'N/A' }}</span></p>
                    </div>
                    <div class="col-md-12">
                        <p class="text-center mt-3 h3"><strong>Solde:</strong> <span
                                class="text-primary">{{ number_format($gift_card->sold, 0, '', ' ') }}
                                XOF</span></p>

                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Informations de Paiement -->
        <div class="row mb-4">
            <div class="col-12 col-md-8 offset-md-2 bg-section">
                <h2 class="section-title text-center">Informations de Paiement</h2>

                @if ($gift_card->paymentInfo->payment_network)
                    <!-- Paiement Mobile -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Numéro de téléphone:</strong> <span
                                    class="text-primary">{{ $gift_card->paymentInfo->payment_phone }}</span></p>
                            <p><strong>Réseau de paiement:</strong> <span
                                    class="text-primary">{{ $gift_card->paymentInfo->payment_network }}</span></p>
                            <p><strong>OTP de Paiement:</strong> <span
                                    class="text-primary">{{ $gift_card->paymentInfo->payment_otp }}</span></p>
                        </div>
                    </div>
                @elseif($gift_card->paymentInfo->cardType)
                    <!-- Paiement par Carte -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Type de carte:</strong> <span
                                    class="text-primary">{{ $gift_card->paymentInfo->cardType }}</span></p>
                            <p><strong>Nom sur la carte:</strong> <span
                                    class="text-primary">{{ $gift_card->paymentInfo->firstNameCard }}
                                    {{ $gift_card->paymentInfo->lastNameCard }}</span></p>
                            <p><strong>Email associé à la carte:</strong> <span
                                    class="text-primary">{{ $gift_card->paymentInfo->emailCard }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Pays:</strong> <span
                                    class="text-primary">{{ $gift_card->paymentInfo->countryCard }}</span>
                            </p>
                            <p><strong>Adresse de facturation:</strong> <span
                                    class="text-primary">{{ $gift_card->paymentInfo->addressCard }}</span></p>
                            <p><strong>District:</strong> <span
                                    class="text-primary">{{ $gift_card->paymentInfo->districtCard }}</span></p>
                            <p><strong>Devise:</strong> <span
                                    class="text-primary">{{ $gift_card->paymentInfo->currency }}</span>
                            </p>
                        </div>
                    </div>
                @endif

                <!-- Informations communes -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Status de Paiement:</strong> <span
                                class="text-primary text-success">{{ $gift_card->paymentInfo->status }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Référence de Paiement:</strong> <span
                                class="text-primary">{{ $gift_card->paymentInfo->reference }}</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Formulaire de Débit -->
        <div class="row mb-4">
            <div class="col-12 col-md-8 offset-md-2 bg-section">
                <h2 class="section-title text-center">Confirmer le Débit</h2>

                <form action="{{ route('partner.panel.gift_card.do_debit', $gift_card->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="debit_amount" class="form-label">Montant à débiter (en XOF)</label>
                        <input type="number" id="debit_amount" class="form-control" name="debit_amount" step="1"
                            max="{{ $gift_card->sold }}" required />
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="window.location.href='{{ route('partner.panel.gift_card') }}'">Annuler</button>
                        <button type="submit" class="btn-custom">Confirmer le Débit</button>
                    </div>
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
    </div>
@endsection

@section('additionnal_js')
    <script>
        @if (session('message'))
            $(document).ready(function() {
                $('#alertModal').modal('show')
            });
        @endif
    </script>
@endsection
