@extends('partner_backoffice.layouts.main')
@section('title')
    Chèques Cadeau
@endsection

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4">Détails du Chèque Cadeau</h2>

        <!-- Étape 1 : Informations du Chèque Cadeau -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Étape 1 : Informations du Chèque Cadeau
            </div>
            <div class="card-body">
                <p><strong>Montant :</strong> {{ $gift_card->amount }} XOF</p>
                <p><strong>Utilisé :</strong> {{ $gift_card->used ? 'Oui' : 'Non' }} </p>

                <p><strong>Message Personnel :</strong> {{ $gift_card->personal_message }}</p>
            </div>
        </div>

        <!-- Étape 2 : Détails du Client -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Étape 2 : Détails du Client
            </div>
            <div class="card-body">
                <p><strong>Nom du Client :</strong> {{ $gift_card->client_name }}</p>
                <p><strong>Email :</strong> {{ $gift_card->client_email }}</p>
                <p><strong>Téléphone :</strong> {{ $gift_card->client_phone }}</p>
            </div>
        </div>

        <!-- Étape 3 : Définir le Bénéficiaire -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Étape 3 : Bénéficiaire
            </div>
            <div class="card-body">
                <p><strong>Est-ce le Client ? :</strong> {{ $gift_card->is_client_beneficiary ? 'Oui' : 'Non' }}</p>
                @if (!$gift_card->is_client_beneficiary)
                    <p><strong>Nom du Bénéficiaire :</strong> {{ $gift_card->beneficiary_name }}</p>
                    <p><strong>Email du Bénéficiaire :</strong> {{ $gift_card->beneficiary_email }}</p>
                    <p><strong>Téléphone du Bénéficiaire :</strong> {{ $gift_card->beneficiary_phone }}</p>
                @endif
            </div>
        </div>

        <!-- Étape 4 : Personnalisation -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Étape 4 : Personnalisation du Chèque Cadeau
            </div>
            <div class="card-body">
                <p><strong>Personnalisation :</strong> {{ $gift_card->is_customized ? 'Oui' : 'Non' }}</p>
            </div>
        </div>

        <!-- Étape 5 : Choix de Livraison -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Étape 5 : Choix de Livraison
            </div>
            <div class="card-body">
                <p><strong>Adresse :</strong> {{ $gift_card->delivery_address }}</p>
                <p><strong>Zone Applicable de livraison :</strong> {{ $gift_card->shipping_zone }}</p>
                <p><strong>Date de Livraison :</strong> {{ $gift_card->delivery_date->format('d F Y') }}</p>
                <p><strong>Numéro de la personne à contacter :</strong> {{ $gift_card->delivery_contact }}</p>
                <p><strong>Statut de Livraison :</strong> {{ $gift_card->getTranslatedShippingStatus() }}</p>
            </div>
        </div>


        <!-- Étape 7 : Paiement -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Étape 7 : Paiement
            </div>
            <div class="card-body">
                <p><strong>Méthode de Paiement :</strong>
                    {{ $gift_card->paymentInfo->payment_network ? 'Mobile Money' : 'Carte Bancaire' }}</p>
                @if ($gift_card->paymentInfo->payment_network)
                    <p><strong>Numéro de Transaction :</strong> {{ $gift_card->paymentInfo->reference }}</p>
                    <p><strong>Status:</strong> {{ $gift_card->paymentInfo->status }}</p>
                    <p><strong>Réseau de Paiement:</strong> {{ $gift_card->paymentInfo->payment_network }}</p>
                    <p><strong>Numéro de Téléphone de Paiement:</strong> {{ $gift_card->paymentInfo->payment_phone }}</p>
                @else
                    <p><strong>Type de Carte:</strong> {{ $gift_card->paymentInfo->cardType }}</p>
                    <p><strong>Nom sur la Carte:</strong> {{ $gift_card->paymentInfo->firstNameCard }}
                        {{ $gift_card->paymentInfo->lastNameCard }}</p>
                    <p><strong>Email sur la Carte:</strong> {{ $gift_card->paymentInfo->emailCard }}</p>
                    <p><strong>Pays:</strong> {{ $gift_card->paymentInfo->countryCard }}</p>
                    <p><strong>Status:</strong> {{ $gift_card->paymentInfo->status }}</p>
                    <p><strong>Référence:</strong> {{ $gift_card->paymentInfo->reference }}</p>
                    <p><strong>Devise:</strong> {{ $gift_card->paymentInfo->currency }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('additionnal_js')
@endsection
