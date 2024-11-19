@extends('partner_backoffice.layouts.main')

@section('title', 'Vue d\'ensemble')

@section('additionnal_css')
    <style>
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="container my-4">
                <h2 class="mb-4">Vue d'ensemble</h2>

                <!-- Cartes des indicateurs clés -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title text-white">Total des commandes</h5>
                                <p class="card-text text-white h3">{{ $totalOrders }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title text-white">Revenus générés</h5>
                                <p class="card-text text-white h3">{{ number_format($totalRevenue, 0, ',', ' ') }} XOF</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info mb-3">
                            <div class="card-body">
                                <h5 class="card-title text-white">Commandes livrées</h5>
                                <p class="card-text text-white h3">{{ $deliveredOrders }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title text-white">Commandes en attente</h5>
                                <p class="card-text text-white h3">{{ $pendingOrders }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Graphique des commandes par mois -->
                <div class="card mb-4">
                    <div class="card-header">Commandes par Mois</div>
                    <div class="card-body">
                        <canvas id="ordersByMonthChart" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Tableau des commandes récentes -->
                <div class="card">
                    <div class="card-header">Commandes Récentes</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Client</th>
                                        <th>Montant (XOF)</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentOrders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->client_name }}</td>
                                            <td>{{ number_format($order->amount, 0, ',', ' ') }}</td>
                                            <td>{{ $order->getTranslatedShippingStatus() }}</td>
                                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additionnal_js')
    <script>
        const ctx = document.getElementById('ordersByMonthChart').getContext('2d');
        const ordersByMonthChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($ordersByMonth->keys()),
                datasets: [{
                    label: 'Commandes',
                    data: @json($ordersByMonth->values()),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
