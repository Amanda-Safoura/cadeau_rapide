@extends('backoffice.layouts.main')

@section('title', 'Tableau de Bord')

@section('additionnal_css')
    <style>
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="container my-4">
                <h2 class="text-center mb-3 fw-bold">Section Utilisateurs</h2>
                <hr class="mb-4" style="border: 1px solid #28a745; opacity: 0.5;">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card bg-success text-white shadow-sm text-center">
                            <div class="card-body">
                                <i class="fas fa-users fa-3x mb-3"></i>
                                <h5 class="card-title text-white">Utilisateurs Inscrits (Ce Mois)</h5>
                                <p class="card-text fs-3 fw-bold">{{ $newUsersThisMonth }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-info text-white shadow-sm text-center">
                            <div class="card-body">
                                <i class="fas fa-fire fa-3x mb-3"></i>
                                <h5 class="card-title text-white">Utilisateurs les Plus Actifs</h5>
                                <ul class="list-unstyled ">
                                    @foreach ($mostActiveUsers as $user)
                                        <li>{{ $user->name }} - {{ $user->gift_cards_count }} chèques cadeaux</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-warning text-dark shadow-sm text-center">
                            <div class="card-body">
                                <i class="fas fa-gift fa-3x mb-3"></i>
                                <h5 class="card-title text-dark">Chèques Cadeaux Non Utilisées</h5>
                                <p class="card-text fs-3 fw-bold">{{ $unusedGiftCardsCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container my-4">
                <h2 class="text-center mb-3 fw-bold">Section Paiements</h2>
                <hr class="mb-4" style="border: 1px solid #007bff; opacity: 0.5;">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white shadow-sm text-center">
                            <div class="card-body">
                                <i class="fas fa-credit-card fa-3x mb-3"></i>
                                <h5 class="card-title text-white">Répartition des Paiements par Méthode</h5>
                                <ul class="list-unstyled">
                                    @foreach ($paymentMethods as $method)
                                        <li>{{ $method->payment_network }} - {{ $method->total }} transactions</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-dark text-white shadow-sm text-center">
                            <div class="card-body">
                                <i class="fas fa-check-circle fa-3x mb-3"></i>
                                <h5 class="card-title text-white">Taux de Réussite des Paiements</h5>
                                <p class="card-text fs-3 fw-bold">{{ number_format($paymentSuccessRate, '0', '', ' ') }}%
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-secondary text-white shadow-sm text-center">
                            <div class="card-body">
                                <i class="fas fa-coins fa-3x mb-3"></i>
                                <h5 class="card-title text-white">Volume des Paiements par Devise</h5>
                                <ul class="list-unstyled">
                                    @foreach ($paymentVolumeByCurrency as $volume)
                                        <li>{{ $volume->currency }} - {{ number_format($volume->total, '0', '', ' ') }} XOF
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container my-4">
                <h2 class="text-center mb-3 fw-bold">Section Livraisons</h2>
                <hr class="mb-4" style="border: 1px solid #dc3545; opacity: 0.5;">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="card bg-warning text-dark shadow-sm text-center">
                            <div class="card-body">
                                <i class="fas fa-map-marker-alt fa-3x mb-3"></i>
                                <h5 class="card-title text-dark">Répartition des Livraisons par Région</h5>
                                <ul class="list-unstyled">
                                    @foreach ($deliveryByRegion as $region)
                                        <li>{{ $region->shipping_zone }} - {{ $region->total }} livraisons</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
