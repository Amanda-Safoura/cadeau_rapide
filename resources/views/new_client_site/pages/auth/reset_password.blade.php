@extends('new_client_site.layouts.auth')

@section('title', 'Enregistrer un nouveau mot de passe')

@section('page_content')
    <div class="col-lg-12 col-md-12">
        <ul class="tabs">
            <li class="current">
                <a href="javascript:void(0);"> <i class="flaticon-contact"></i>
                    Réinitialisation du mot de passe</a>
            </li>
        </ul>
    </div>

    <div class="col-lg-12 col-md-12">
        <div class="tab_content current active">
            <div class="tabs_item">
                <div class="user-all-form">
                    <div class="contact-form">
                        <!-- Formulaire de mot de passe -->
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="form-group">
                                        <i class="bx bx-user"></i>
                                        <input class="form-control" type="email" name="email" placeholder="Adresse mail"
                                            required>
                                    </div>
                                </div>
                                @error('email')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="col-lg-12 col-md-12 text-center">
                                    <button type="submit" class="default-btn user-all-btn disabled">
                                        Envoyer le lien de réinitialisation
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
