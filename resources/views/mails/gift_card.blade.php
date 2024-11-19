<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Chèque Cadeau</title>
    <link href="{{ asset('assets/backoffice/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/new_client_side/css/font-awesome.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f5f5f5;
            /* Fond gris clair */
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Wrapper */
        .email-wrapper {
            background-color: #f5f5f5;
            /* Fond gris clair */
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 20px auto;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #002867, #e7b50a);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .header img {
            max-height: 80px;
            display: block;
            margin: 0 auto 15px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
            font-weight: bold;
        }

        /* Content Section */
        .content {
            background-color: #ffffff;
            /* Fond contrasté pour le contenu */
            padding: 30px;
            border-radius: 8px;
        }

        .content h5 {
            color: #002867;
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .content p {
            font-size: 16px;
            line-height: 1.8;
        }

        /* Table Styling */
        .info-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .info-table th {
            text-align: left;
            font-weight: bold;
            color: #002867;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
        }

        .info-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        /* Message Box */
        .message-box {
            margin-top: 20px;
            padding: 20px;
            background-color: #e7b50a;
            color: #002867;
            border-radius: 8px;
            font-size: 16px;
            line-height: 1.6;
        }

        .message-box strong {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
        }

        /* Footer */
        .footer {
            background-color: #2d2d2d;
            /* Gris foncé pour footer */
            color: white;
            padding: 40px 30px;
            border-top: 5px solid #e7b50a;
        }

        .footer h5 {
            color: #e7b50a;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .footer p,
        .footer a {
            font-size: 14px;
            color: #e7b50a;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .footer .social-icons a {
            margin-right: 15px;
            font-size: 20px;
            color: #e7b50a;
            transition: color 0.3s ease;
        }

        .footer .social-icons a:hover {
            color: #ffd700;
        }

        /* Buttons */
        .btn-custom {
            text-decoration: none;
            display: inline-block;
            color: #002867 !important;
            background-color: #e7b50a;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #ffd700;
            color: #002867;
        }

        .btn-block {
            display: block;
            width: 80%;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <!-- Header -->
        <div class="header">
            <img src="{{ url('assets/LOGO CADEAURAPIDE.png') }}" alt="Logo">
            <h1>Votre Chèque Cadeau</h1>
            <p>Offrez un moment spécial à vos proches avec Cadeau Rapide.</p>
        </div>

        <!-- Content -->
        <div class="content">
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
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="row">
                <div class="col-md-4">
                    <h5>À propos</h5>
                    <p>Cadeau Rapide est votre solution pour offrir des chèques cadeaux personnalisés.</p>
                </div>
                <div class="col-md-4 text-center">
                    <h5>Suivez-nous</h5>
                    <div class="social-icons">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Contactez-nous</h5>
                    <p><i class="fa fa-envelope"></i> <a
                            href="mailto:contact@cadeaurapide.com">contact@cadeaurapide.com</a></p>
                    <p><i class="fa fa-phone"></i> +229 123 456 789</p>
                    <a href="#" class="btn-custom btn-block">Devenir Partenaire</a>
                    <a href="#" class="btn-custom btn-block">Commander un Chèque Cadeau</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
