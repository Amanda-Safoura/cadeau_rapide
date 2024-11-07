@extends('new_client_site.layouts.main')

@section('title', 'Vérification chèque cadeau')

@section('additionnal_css')
    <style>
        .card-invalid {
            max-width: 400px;
            background: linear-gradient(135deg, #f8d7da, #ffffff);
            border: 1px solid #f5c6cb;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 2rem;
        }

        .text-danger-custom {
            color: #dc3545;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .btn-outline-secondary-custom {
            border-color: #6c757d;
            color: #6c757d;
            transition: color 0.3s, border-color 0.3s;
        }

        .btn-outline-secondary-custom:hover {
            color: #ffffff;
            background-color: #6c757d;
        }
    </style>
@endsection

@section('content')

    <!-- Inner Banner -->
    <div class="inner-banner inner-bg1">
        <div class="container">
            <div class="inner-title text-center">
                <h3>Vérification chèque cadeau</h3>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card-invalid text-center">
            <h2 class="text-danger-custom mb-3"> <i class="fas fa-times-circle"></i> Chèque Cadeau Invalide</h2>
            <p class="card-text mb-4 text-secondary">Désolé, ce chèque-cadeau est soit invalide, soit son solde est épuisé.
            </p>
            <div class="mt-4">
                <a href="{{ route('client.home') }}" class="btn btn-outline-secondary-custom btn-lg px-4">Retour à
                    l'accueil</a>
            </div>
        </div>
    </div>
@endsection

@section('additionnal_js')

@endsection
