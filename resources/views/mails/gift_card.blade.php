<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Chèque Cadeau</title>
    <link href="{{ asset('assets/backoffice/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container my-4">
        <!-- En-tête avec logo -->
        <div class="text-center mb-4">
            <img src="{{ asset('assets/LOGO CADEAURAPIDE.png') }}" alt="Logo" style="max-width: 150px;">
            <h2 class="mt-3">CADEAU RAPIDE</h2>
        </div>

        <!-- Informations principales du chèque cadeau -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Détails du Chèque Cadeau</h5>
                <p class="card-text">
                    Bonjour {{ $gift_card->beneficiary_name }},<br>
                    Vous avez reçu un chèque cadeau d'une valeur de <strong>{{ $gift_card->amount }} XOF</strong> !
                </p>
            </div>
        </div>

        <!-- Informations additionnelles -->
        <div class="mt-4">
            <h5>Informations du Chèque</h5>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row">Numéro du Chèque</th>
                        <td>{{ $gift_card->id }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Expéditeur</th>
                        <td>{{ $gift_card->client_name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Montant</th>
                        <td>{{ $gift_card->amount }} XOF</td>
                    </tr>
                    <tr>
                        <th scope="row">Date de début de validité</th>
                        <td>{{ $gift_card->created_at->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Durée de validité</th>
                        <td>{{ $gift_card->giftCardShipping->validity_duration }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Message personnel (optionnel) -->
        @if ($gift_card->personal_message)
            <div class="alert alert-secondary mt-4" role="alert">
                <strong>Message de {{ $gift_card->client_name }} :</strong><br>
                {{ $gift_card->personal_message }}
            </div>
        @endif

        <!-- Pied de page avec note -->
        <div class="text-center mt-4">
            <p class="text-muted">
                Merci d'utiliser notre service de chèques cadeaux ! <br>
                Pour toute question, contactez-nous à <a
                    href="mailto:contact@cadeaurapide.com">contact@cadeaurapide.com</a>.
            </p>
        </div>
    </div>
</body>

</html>
