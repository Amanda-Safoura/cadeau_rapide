<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chèque Cadeau</title>
    <link href="{{ asset('assets/backoffice/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        .gift-card {
            background-color: #ffffff;
            width: 900px;
            height: 470px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: auto;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .gift-card-header {
            background-color: #005073;
            color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            font-size: 1.8em;
            font-weight: bold;
            position: relative;
        }

        .gift-card-header h2 {
            margin: 0;
            font-size: 1.5em;
            text-transform: uppercase;
            flex-grow: 1;
            text-align: center;
        }

        .partner-name {
            font-size: 0.7em;
            /* Taille de police par défaut */
            font-weight: 700;
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
        }


        .partner-logo {
            max-height: 40px;
            position: absolute;
            right: 10px;
            top: 20px;
        }

        .partner-section {
            width: 30%;
            background: url("{{ asset('storage/' . $gift_card->partner->picture_1) }}") center center / cover no-repeat;
            position: relative;
        }

        .separator {
            width: 10px;
            background-color: #800020;
        }

        .details-section {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 60%;
            position: relative;
        }

        .details-section p {
            font-size: 1em;
            color: #333;
            margin: 5px 0;
        }

        .validity {
            font-size: 0.9em;
            color: #555;
        }

        .footer {
            background-color: #e7b50a;
            color: #002867;
            padding: 10px 20px;
            font-size: 1em;
            font-weight: bold;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .gift-card-body {
            display: flex;
            height: 100%;
        }

        .qr-code {
            position: absolute;
            top: 20px;
            right: -65px;
        }
    </style>
</head>

<body>
    <div class="gift-card">
        <!-- Header avec "Chèque Cadeau", le nom du partenaire et le logo du site -->
        <div class="gift-card-header">
            <span class="partner-name">{{ $gift_card->partner->name }}</span>
            <h2 class="me-5">Chèque Cadeau</h2>
            <img src="{{ asset('assets/LOGO CADEAURAPIDE.png') }}" alt="Logo Site Web" class="partner-logo">
        </div>

        <!-- Section du contenu principal de la chèque cadeau -->
        <div class="gift-card-body">
            <!-- Section gauche avec l'image du partenaire -->
            <div class="partner-section">
                <!-- Image du partenaire comme fond de la div -->
            </div>

            <!-- Trait de séparation rouge bordeaux -->
            <div class="separator"></div>

            <!-- Section droite avec les informations du chèque cadeau -->
            <div class="details-section">
                <!-- Montant et détails -->
                <div>
                    <p><strong>Montant :</strong> {{ number_format($gift_card->amount, '0', '', ' ') }} XOF</p>
                    <p><strong>Offert à :</strong> {{ $gift_card->is_client_beneficiary ? $gift_card->client_name : $gift_card->beneficiary_name }}</p>
                    <p><strong>Par :</strong> {{ $gift_card->client_name }}</p>
                    <p class="validity"><strong>Validité :</strong> Valable {{ $gift_card->validity_duration }} mois à
                        compter du {{ $gift_card->delivery_date->translatedFormat('d F Y') }}
                    </p>
                    @if ($gift_card->personal_message)
                        Voici quelques mots de votre donateur:
                        <br>{{ $gift_card->personal_message }}
                    @endif
                </div>

                <!-- Code QR -->
                <div class="qr-code">
                    {!! QrCode::size(80)->generate("{{ route('client.gift_card.check', ['gift_card_id' => $gift_card->id]) }}") !!}
                </div>
                <!-- Modalités d'utilisation -->
                <div>
                    <p class="pb-5 ps-2">Utilisable uniquement chez le partenaire affilié. Non
                        remboursable.
                        <br>
                        Ce chèque ne sera plus valable une fois la date d'expiration passée.
                    </p>
                </div>

            </div>
        </div>

        <!-- Footer avec le numéro de chèque cadeau -->
        <div class="footer">
            <span>Numéro du chèque cadeau : #{{ $gift_card->id }}</span>
        </div>
    </div>
</body>

</html>
