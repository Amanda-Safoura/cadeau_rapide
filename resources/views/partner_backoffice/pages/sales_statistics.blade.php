@extends('partner_backoffice.layouts.main')

@section('title', 'Statistiques des Ventes')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="container">
                <!-- Résumé des Ventes Globales -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>Total des Ventes</h5>
                                <p>{{ $totalSales }} chèques cadeaux</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>Revenu Total</h5>
                                <p>{{ number_format($totalRevenue, '0', '', ' ') }} XOF</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>Montant Moyen</h5>
                                <p>{{ number_format($averageAmount, '0', '', ' ') }} XOF</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Analyse par Statut de Livraison -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h4>Analyse par Statut de Livraison</h4>
                        <canvas id="shippingStatusChart"></canvas>
                    </div>
                </div>

                <!-- Performance par Période -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h4>Ventes Mensuelles</h4>
                        <canvas id="monthlySalesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('additionnal_js')
    <script>
        const shippingStatusData = @json($ordersByShippingStatus);
        const monthlySalesData = @json($monthlySales);

        // Graphique par Statut de Livraison
        const shippingStatusChart = new Chart(document.getElementById('shippingStatusChart'), {
            type: 'pie',
            data: {
                labels: shippingStatusData.map(status => status.shipping_status),
                datasets: [{
                    data: shippingStatusData.map(status => status.total),
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                }]
            }
        });

        // Graphique des Ventes Mensuelles
        const monthlySalesChart = new Chart(document.getElementById('monthlySalesChart'), {
            type: 'bar',
            data: {
                labels: monthlySalesData.map(sale => sale.month_name), // Utilisation des noms des mois
                datasets: [{
                        label: 'Ventes',
                        data: monthlySalesData.map(sale => sale.total_sales),
                        backgroundColor: '#4e73df',
                    },
                    {
                        label: 'Revenu',
                        data: monthlySalesData.map(sale => sale.total_revenue),
                        backgroundColor: '#36b9cc',
                    }
                ]
            }
        });
    </script>
@endsection
