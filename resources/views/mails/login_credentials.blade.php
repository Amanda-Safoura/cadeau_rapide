<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Chèque Cadeau</title>
    <link href="{{ asset('assets/backoffice/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

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

        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            background-color: #f9f9f9;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }

        .card-body {
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <!-- Header -->
        <div class="header">
            <img src="{{ url('assets/LOGO CADEAURAPIDE.png') }}" alt="Logo">
        </div>

        <!-- Content -->
        <div class="content">
            <div class="card">
                <div class="card-header">
                    Bonjour {{ $name }},
                </div>
                <div class="card-body">
                    <p>Votre compte a été créé avec succès !</p>
                    <p>Voici vos identifiants de connexion :</p>
                    <ul>
                        <li><strong>Adresse e-mail :</strong> {{ $email }}</li>
                        <li><strong>Mot de passe :</strong> {{ $password }}</li>
                    </ul>
                    <p>Ces identifiants ne sont connus que de vous.</p>
                    <p><strong>Veuillez bien conserver ce mot de passe.</strong></p>
                    <p style="text-align: center; margin-top: 20px;">
                        <a href="{{ $loginUrl }}" class="btn-custom">Connexion à votre compte</a>
                    </p>
                    <p style="margin-top: 30px; text-align: center;">
                        Merci de faire partie de notre communauté !
                    </p>
                </div>
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
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Contactez-nous</h5>
                        <p><i class="fas fa-envelope"></i> <a
                                href="mailto:contact@cadeaurapide.com">contact@cadeaurapide.com</a></p>
                        <p><i class="fas fa-phone"></i> +229 123 456 789</p>
                        <a href="#" class="btn-custom btn-block">Devenir Partenaire</a>
                        <a href="#" class="btn-custom btn-block">Commander un Chèque Cadeau</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
