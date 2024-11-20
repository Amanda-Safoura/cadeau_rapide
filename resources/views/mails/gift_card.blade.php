@extends('mails.layouts.main')

@section('header')
    <h1>Votre Chèque Cadeau</h1>
    <p>Offrez un moment spécial à vos proches avec Cadeau Rapide.</p>
@endsection

@section('content')
    <h5>Détails du Chèque Cadeau</h5>
    <p>
        Bonjour {{ $gift_card->beneficiary_name }},<br>
        Vous avez reçu un chèque cadeau d'une valeur de <strong>{{ $gift_card->amount }} XOF</strong> !
    </p>

    <h5>Informations du Chèque</h5>
    <div class="table-responsive">
        <table class="info-table">
            <tbody>
                <tr>
                    <th>Numéro du Chèque</th>
                    <td>#{{ $gift_card->id }}</td>
                </tr>
                <tr>
                    <th>Expéditeur</th>
                    <td>{{ $gift_card->client_name }}</td>
                </tr>
                <tr>
                    <th>Partenaire</th>
                    <td>{{ $gift_card->partner->name }}</td>
                </tr>
                <tr>
                    <th>Montant</th>
                    <td>{{ $gift_card->amount }} XOF</td>
                </tr>
                <tr>
                    <th>Date de début de validité</th>
                    <td>{{ $gift_card->created_at->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>Durée de validité</th>
                    <td>{{ $gift_card->validity_duration ?? 0 }} mois</td>
                </tr>
            </tbody>
        </table>
    </div>

    @if ($gift_card->personal_message)
        <div class="message-box">
            <strong>Message de {{ $gift_card->client_name }} :</strong>
            {{ $gift_card->personal_message }}
        </div>
    @endif
@endsection
