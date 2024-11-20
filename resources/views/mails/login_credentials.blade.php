@extends('mails.layouts.main')

@section('content')
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
@endsection
