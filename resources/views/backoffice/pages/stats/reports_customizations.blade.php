@extends('backoffice.layouts.main')

@section('title', 'Statistiques de Vente')

@section('content')
    <div class="container">
        <div class="card p-4">
            <div class="card-body">
                <!-- Formulaire pour filtrer les personnalisations -->
                <form method="GET" action="{{ route('dashboard.stats.reports_customizations') }}" class="row g-3 mb-4">
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

                <!-- Tableau des rapports de personnalisations -->
                <h5>Rapport des Personnalisations</h5>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre de Chèques Cadeaux Personnalisés</th>
                            <th>Revenu Total des Personnalisations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $customizationsStats['total_customized'] }}</td>
                            <td>{{ number_format($customizationsStats['total_revenue'], '0', '', ' ') }} XOF</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Graphique des personnalisations (Chart.js) -->
                <div class="mt-4">
                    <canvas id="customizationChart"></canvas>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('additionnal_js')
    <script>
        let ctx = document.getElementById('customizationChart').getContext('2d');
        let customizationChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Personnalisations'], // Label unique pour ce rapport
                datasets: [{
                    label: 'Nombre de Chèques Cadeaux Personnalisés',
                    data: [
                    {{ $customizationsStats['total_customized'] }}], // Nombre de chèques personnalisés
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }, {
                    label: 'Revenu Total des Personnalisations',
                    data: [
                    {{ $customizationsStats['total_revenue'] }}], // Revenu total des personnalisations
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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
