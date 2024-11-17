@extends('backoffice.layouts.main')

@section('title', 'Statistiques de Vente')

@section('content')
    <div class="container">
        <div class="card p-4">
            <div class="card-body">
                <!-- Formulaire pour sélectionner la période -->
                <form method="GET" action="{{ route('dashboard.stats.sales') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Date de début</label>
                        <input type="date" id="start_date" name="start_date" class="form-control"
                            value="{{ \Carbon\Carbon::parse($startDate)->toDateString() }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Date de fin</label>
                        <input type="date" id="end_date" name="end_date" class="form-control"
                            value="{{ \Carbon\Carbon::parse($endDate)->toDateString() }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filtrer</button>
                    </div>
                </form>

                <!-- Statistiques -->
                <div class="mt-4">
                    <h3>Statistiques des Ventes</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Nombre total de commandes : </strong>{{ $totalOrders }}</li>
                        <li class="list-group-item"><strong>Revenu total :
                            </strong>{{ number_format($totalRevenue, '0', '', ' ') }} XOF</li>
                        <li class="list-group-item"><strong>Montant moyen des chèques cadeaux :
                            </strong>{{ number_format($averageAmount, '0', '', ' ') }} XOF</li>
                    </ul>
                </div>

            </div>
            <!-- Graphique des ventes -->
            <canvas id="salesChart"></canvas>

        </div>
    </div>
@endsection

@section('additionnal_js')
    <script>
        let ctx = document.getElementById('salesChart').getContext('2d');
        let salesData = {
            labels: ['Total des Ventes'],
            datasets: [{
                label: 'Total des Revenus',
                data: [{{ $totalRevenue }}],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        let chart = new Chart(ctx, {
            type: 'pie',
            data: salesData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return 'XOF ' + tooltipItem.raw.toFixed(2);
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
