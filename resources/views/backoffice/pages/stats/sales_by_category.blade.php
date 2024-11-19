@extends('backoffice.layouts.main')

@section('title', 'Statistiques de Vente')

@section('content')
    <div class="container">
        <div class="card p-4">
            <div class="card-body">
                <!-- Formulaire pour filtrer les ventes par date -->
                <form method="GET" action="{{ route('dashboard.stats.sales_by_category') }}" class="row g-3 mb-4">
                    <div class="col-md-5">
                        <label for="start_date" class="form-label">Date de début</label>
                        <input type="date" name="start_date" id="start_date" class="form-control"
                            value="{{ \Carbon\Carbon::parse($startDate)->toDateString() }}">
                    </div>
                    <div class="col-md-5">
                        <label for="end_date" class="form-label">Date de fin</label>
                        <input type="date" name="end_date" id="end_date" class="form-control"
                            value="{{ \Carbon\Carbon::parse($endDate)->toDateString() }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                    </div>
                </form>

                <!-- Tableau des statistiques par catégorie -->
                <h5>Statistiques des ventes par catégorie</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Catégorie</th>
                                <th>Nombre de Commandes</th>
                                <th>Revenu Total</th>
                                <th>Montant Moyen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoriesStats as $stat)
                                <tr>
                                    <td>{{ $stat['category'] }}</td>
                                    <td>{{ $stat['totalOrders'] }}</td>
                                    <td>{{ number_format($stat['totalRevenue'], '0', '', ' ') }} XOF</td>
                                    <td>{{ number_format($stat['averageAmount'], '0', '', ' ') }} XOF</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Graphique des ventes par catégorie (Chart.js) -->
                <div class="mt-4">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additionnal_js')
    <script>
        let ctx = document.getElementById('categoryChart').getContext('2d');
        let categoryChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json(array_map(function ($stat) {
                        return $stat['category'];
                    }, $categoriesStats)), // Catégories
                datasets: [{
                    label: 'Revenu Total par Catégorie',
                    data: @json(array_map(function ($stat) {
                            return $stat['totalRevenue'];
                        }, $categoriesStats)), // Revenu total par catégorie
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
