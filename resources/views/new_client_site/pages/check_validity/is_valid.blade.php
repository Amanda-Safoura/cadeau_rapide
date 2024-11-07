@extends('new_client_site.layouts.main')

@section('title', 'Vérification chèque cadeau')

@section('additionnal_css')
    <style>
        .card-custom {
            max-width: 500px;
            background: linear-gradient(135deg, #e0f7fa, #ffffff);
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 2rem;
        }

        .text-success-custom {
            color: #28a745;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .btn-custom {
            background-color: #28a745;
            border-color: #28a745;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-custom:hover {
            background-color: #218838;
            transform: scale(1.05);
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
        <div class="card-custom text-center">
            <h2 class="text-success-custom mb-3"> <i class="fas fa-check-circle"></i> Chèque Cadeau Valide !</h2>
            <p class="card-text mb-4 text-secondary">Félicitations ! Votre chèque-cadeau est prêt à être utilisé.</p>
            <h5 class="card-text text-muted">Solde Disponible :</h5>
            <h3 class="text-primary fw-bold display-5">{{ number_format($gift_card->sold, 0, '', ' ') }} XOF</h3>
            <div class="mt-4">
                <a href="{{ route('partner.panel.gift_card.debit', ['id' => $gift_card->id]) }}"
                    class="btn btn-custom btn-lg px-4">Débiter ce chèque cadeau</a>
            </div>
        </div>
    </div>
@endsection

@section('additionnal_js')

@endsection
