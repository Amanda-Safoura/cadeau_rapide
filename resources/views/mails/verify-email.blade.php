@extends('mails.layouts.main')

@section('mail_content')
    <div class="content">
        <div class="card mx-auto" style="max-width: 500px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div class="card-body text-center">
                <h1 class="card-title text-dark">Bienvenue !</h1>
                <p class="card-text" style="color: #6c757d">Merci de vous être inscrit(e) ! Veuillez vérifier votre adresse mail pour compléter
                    votre inscription.</p>
                <a href="{{ route('client.verify-email', ['token' => $token]) }}" class="btn btn-primary btn-lg"
                    style="margin-top: 20px; background-color:#e7b50a; border:#e7b50a solid 1px">Vérifier mon adresse
                    mail</a>
                <p style="margin-top: 20px; font-size: 0.9rem; color: #6c757d">Si vous n'avez pas créé de compte, veuillez
                    ignorer cet e-mail.</p>
            </div>
        </div>
    </div>
@endsection
