@extends('backoffice.layouts.main')
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
    <div class="container my-5">

        <div class="card p-4">
            <div class="card-body">
                <!-- Tabs Selector -->
                <ul class="nav nav-tabs" id="revenueTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="partners-tab" data-bs-toggle="tab" data-bs-target="#partners"
                            type="button" role="tab" aria-controls="partners" aria-selected="true">Revenus par
                            Partenaire</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="categories-tab" data-bs-toggle="tab" data-bs-target="#categories"
                            type="button" role="tab" aria-controls="categories" aria-selected="false">Revenus par
                            Catégorie</button>
                    </li>
                </ul>

                <!-- Tabs Content -->
                <div class="tab-content" id="revenueTabsContent">

                    <!-- Revenus par Partenaire -->
                    <div class="tab-pane fade show active" id="partners" role="tabpanel" aria-labelledby="partners-tab">
                        <div class="row my-4">
                            <!-- Global Totals Cards -->
                            <div class="col-md-4">
                                <div class="custom-card">
                                    <div class="icon-container">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <div>
                                        <div class="label">Total Frais de Livraison</div>
                                        <div class="amount">{{ $total_delivery_revenue }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-card">
                                    <div class="icon-container">
                                        <i class="fas fa-paint-brush"></i>
                                    </div>
                                    <div>
                                        <div class="label">Total Frais de Personnalisation</div>
                                        <div class="amount">{{ $total_customization_revenue }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-card">
                                    <div class="icon-container">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                    <div>
                                        <div class="label">Total Chèques Cadeaux</div>
                                        <div class="amount">{{ $total_price_gift_card }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table des Revenus par Partenaire -->
                        <div class="table-responsive">
                            <table id="partnerTable" class="display table table-striped table-bordered bg-white"
                                cellspacing="0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Partenaire</th>
                                        <th>Revenu Frais Livraison</th>
                                        <th>Revenu Frais Personnalisation</th>
                                        <th>Valeurs des Chèques Cadeaux</th>
                                        <th>Commission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($partners_with_revenue_datas as $partner)
                                        <tr>
                                            <td>{{ $partner['name'] }}</td>
                                            <td>{{ $partner['delivery_revenue'] }} XOF</td>
                                            <td>{{ number_format($partner['customization_revenue'], 0, '', ' ') }} XOF</td>
                                            <td>{{ number_format($partner['price_gift_card'], 0, '', ' ') }} XOF</td>
                                            <td>{{ number_format($partner['commission'], 0, '', ' ') }} XOF</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Revenus par Catégorie -->
                    <div class="tab-pane fade" id="categories" role="tabpanel" aria-labelledby="categories-tab">
                        <!-- Table des Revenus par Catégorie -->
                        <div class="table-responsive">
                            <table id="categoryTable" class="display table table-striped table-bordered bg-white"
                                cellspacing="0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Catégorie</th>
                                        <th>Revenu Livraison</th>
                                        <th>Revenu Personnalisation</th>
                                        <th>Prix des Chèques Cadeaux</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Exemple de ligne de données pour chaque catégorie -->
                                    @foreach ($category_revenues as $category)
                                        <tr>
                                            <td>{{ $category['category_name'] }}</td>
                                            <td>{{ $category['total_delivery_revenue'] }} XOF</td>
                                            <td>{{ $category['total_customization_revenue'] }} XOF</td>
                                            <td>{{ $category['total_price_gift_card'] }} XOF</td>
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
    <!-- DataTable -->
    <script src="{{ asset('assets/backoffice/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/backoffice/js/plugin/datatables/dataTables.bootstrap5.min.js') }}"></script>

    <script>
        let partnerTable = $('#partnerTable').DataTable()
        let categoryTable = $('#categoryTable').DataTable()
    </script>
@endsection
