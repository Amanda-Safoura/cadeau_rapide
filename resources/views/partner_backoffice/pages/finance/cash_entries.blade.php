@extends('partner_backoffice.layouts.main')
@section('title')
    Revenus
@endsection

@section('additionnal_css')
    <!-- Bootstrap DataTable -->
    <link rel="stylesheet" href="{{ asset('assets/backoffice/css/dataTables.bootstrap5.min.css') }}">
    <style>
        .custom-card {
            background-color: #f8f9fa;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            height: 100%;
            /* Toutes les cartes auront la même hauteur */
        }

        .icon-container {
            background-color: #e5f7ee;
            border-radius: 50%;
            padding: 10px;
            color: #28a745;
            font-size: 24px;
        }

        .amount {
            font-size: 1.5rem;
            font-weight: bold;
            color: #212529;
        }

        .label {
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h1 class="mb-4">Récapitulatif des chèques cadeaux</h1>

        <div class="row mb-4 g-3">
            <!-- Taux de commission -->
            <div class="col-12 col-md-3">
                <div class="custom-card">
                    <div class="icon-container">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div>
                        <div class="label">Taux de commission</div>
                        <div class="amount">{{ $partner->commission_percent }} %</div>
                    </div>
                </div>
            </div>

            <!-- Total des ventes -->
            <div class="col-12 col-md-3">
                <div class="custom-card">
                    <div class="icon-container">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div>
                        <div class="label">Total des ventes</div>
                        <div class="amount">{{ number_format($totalAmount, '0', '', ' ') }} XOF</div>
                    </div>
                </div>
            </div>

            <!-- Total des commissions -->
            <div class="col-12 col-md-3">
                <div class="custom-card">
                    <div class="icon-container">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div>
                        <div class="label">Total des commissions</div>
                        <div class="amount">{{ number_format($totalCommission, '0', '', ' ') }} XOF</div>
                    </div>
                </div>
            </div>

            <!-- Chèques cadeaux vendus -->
            <div class="col-12 col-md-3">
                <div class="custom-card">
                    <div class="icon-container">
                        <i class="fas fa-gift"></i>
                    </div>
                    <div>
                        <div class="label">Chèques cadeaux vendus</div>
                        <div class="amount">{{ $totalSold }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des chèques cadeaux -->
        <div class="table-responsive">
            <table id="categoryTable" class="display table table-striped table-bordered bg-white" cellspacing="0"
                style="width:100%">
                <thead>
                    <tr>
                        <th>Montant (XOF)</th>
                        <th>Commission (XOF)</th>
                        <th>Revenu (XOF)</th>
                        <th>Date d'émission</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($summary as $data)
                        <tr>
                            <td>{{ number_format($data['amount'], '0', '', ' ') }}</td>
                            <td>{{ number_format($data['commission'], '0', '', ' ') }}</td>
                            <td>{{ number_format($data['amount'] - $data['commission'], '0', '', ' ') }}</td>
                            <td>{{ $data['delivery_date'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Aucune vente enregistrée pour ce partenaire.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection



@section('additionnal_js')
    <!-- DataTable -->
    <script src="{{ asset('assets/backoffice/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/backoffice/js/plugin/datatables/dataTables.bootstrap5.min.js') }}"></script>

    <script>
        let partnerTable = $('#partnerTable').DataTable()
        let categoryTable = $('#categoryTable').DataTable()
    </script>
@endsection
