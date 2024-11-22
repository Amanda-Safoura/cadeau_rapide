@extends('mails.layouts.main')

@section('mail_content')
    <div class="content text-start">
        <h5>Votre Chèque Cadeau: Détails</h5>
        <p>
            Bonjour {{ $gift_card->client_name }},<br>
            Vous avez créé un chèque cadeau d'une valeur de <strong>{{ $gift_card->amount }} XOF</strong> !
        </p>

        <h5 class="mt-4 mb-0 p-0">Informations du Chèque</h5>
        <div class="table-responsive">
            <table class="info-table">
                <tbody>
                    <tr>
                        <th>Numéro du Chèque</th>
                        <td>#{{ $gift_card->id }}</td>
                    </tr>
                    <tr>
                        <th>Bénéficiaire</th>
                        <td>
                            {{ $gift_card->is_client_beneficiary ? $gift_card->client_name : $gift_card->beneficiary_name }}
                        </td>
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
                        <td>{{ $gift_card->delivery_date->format('d/m/Y') }}</td>
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

        <div class="mt-4">
            <p>
                <strong>Livraison :</strong>
                Le chèque cadeau sera livré au bénéficiaire avant le début de sa date de validité
                (<strong>{{ $gift_card->delivery_date->format('d/m/Y') }}</strong>), afin qu'il puisse en profiter dès que
                possible.
            </p>
            <p>
                <strong>Conditions d’utilisation :</strong>
                Ce chèque cadeau est valable uniquement chez notre partenaire
                <strong>{{ $gift_card->partner->name }}</strong> et doit être utilisé dans les
                <strong>{{ $gift_card->validity_duration ?? 0 }} mois</strong> suivant sa date de début de validité.
            </p>
            <p>
                Si vous avez des questions ou si vous souhaitez obtenir de l’assistance, n’hésitez pas à nous contacter.
                Merci d’avoir choisi notre service pour offrir un moment spécial à vos proches !
            </p>
        </div>
    </div>
@endsection
