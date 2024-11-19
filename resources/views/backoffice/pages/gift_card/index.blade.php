@extends('backoffice.layouts.main')
@section('title')
    Chèques Cadeau
@endsection

@section('additionnal_css')
    <!-- Bootstrap DataTable -->
    <link rel="stylesheet" href="{{ asset('assets/backoffice/css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-end">

            <div class="custom-dropdown mx-3">
                <button class="btn-primary custom-dropdown-toggle" type="button" id="filter-used_status">
                    Filtrer par statut d'utilisation
                </button>
                <ul class="custom-dropdown-menu">
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-used_status', 'Comptabilisés')">Comptabilisés</a></li>
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-used_status', 'Non Utilisés')">Non Utilisés</a>
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-used_status', 'Tous')">Tous</a>
                    </li>
                </ul>
            </div>

            <div class="custom-dropdown me-3">
                <button class="btn-primary custom-dropdown-toggle" type="button" id="filter-delivery_status">
                    Filtrer par statut de livraison
                </button>
                <ul class="custom-dropdown-menu">
                    <li>
                        <a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-delivery_status', 'En attente de traitement')">En attente de
                            traitement</a>
                    </li>
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-delivery_status', 'En cours')">En cours</a></li>
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-delivery_status', 'Livrés')">Livrés</a>
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-delivery_status', 'Tous')">Tous</a>
                    </li>
                </ul>
            </div>

            <div class="custom-dropdown me-3">
                <button class="custom-dropdown-toggle btn-primary" id="filter-paid" type="button">
                    Filtrer par statut de paiement
                </button>
                <ul class="custom-dropdown-menu">
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-paid', 'Acquittés')">Acquittés</a></li>
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-paid', 'Impayés')">Impayés</a></li>
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-paid', 'Tous')">Tous</a>
                    </li>
                </ul>
            </div>

            <div class="custom-dropdown me-3">
                <button class="btn-primary custom-dropdown-toggle" type="button" id="filter-customization">
                    Filtrer par demande de personnalisation
                </button>
                <ul class="custom-dropdown-menu">
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-customization', 'Personnalisés')">Personnalisés</a></li>
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-customization', 'Standards')">Standards</a></li>
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-customization', 'Tous')">Tous</a></li>
                </ul>
            </div>
        </div>

        <div class="table-responsive">
            <table id="editableTable" class="display table table-striped table-bordered bg-white" cellspacing="0"
                style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client</th>
                        <th>Bénéficiaire</th>
                        <th>Partenaire</th>
                        <th>Montant (XOF)</th>
                        <th>Somme totale payé (XOF)</th>
                        <th>Utilisé</th>
                        <th>Customisé</th>
                        <th>Payé</th>
                        <th>Statut de livraison</th>
                        <th>Date de commande</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $gift_card)
                        <tr>
                            <td>{{ $gift_card->id }}</td>
                            <td>{{ $gift_card->client_name }}</td>
                            <td>
                                @if ($gift_card->is_client_beneficiary)
                                    Le client lui-même
                                @else
                                    {{ $gift_card->beneficiary_name }}
                                @endif
                            </td>
                            <td>{{ $gift_card->partner->name }} </td>
                            <td>{{ $gift_card->amount }}</td>
                            <td>{{ $gift_card->total_amount }}</td>
                            <td class="text-center">
                                @if ($gift_card->used)
                                    <span class="bg-success text-white p-1"><span class="d-none">Comptabilisés</span><i
                                            class="fas fa-check"></i></span>
                                @else
                                    <span class="bg-danger text-white px-2 py-1"><span class="d-none">Non Utilisés</span><i
                                            class="fas fa-times"></i></span>
                                @endif
                            </td>
                            <td class=" text-center">
                                @if ($gift_card->is_customized)
                                    <span class="bg-success text-white p-1"><span class="d-none">Personnalisés</span><i
                                            class="fas fa-check"></i></span>
                                @else
                                    <span class="bg-danger text-white px-2 py-1"><span class="d-none">Standards</span><i
                                            class="fas fa-times"></i></span>
                                @endif
                            </td>
                            <td>
                                @if ($gift_card->paymentInfo->status === 'SUCCESSFUL')
                                    <span class="bg-success text-white p-1">
                                        <span class="d-none">Acquittés</span>
                                        <i class="fas fa-check"></i>
                                    </span>
                                @elseif ($gift_card->paymentInfo->status === 'FAILED')
                                    <span class="bg-danger text-white px-2 py-1">
                                        <span class="d-none">Impayés</span>
                                        <i class="fas fa-times"></i>
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($gift_card->shipping_status === 'awaiting processing')
                                    <span class="bg-info text-white p-1">
                                        <span class="d-none">En attente de traitement</span>
                                        <i class="fas fa-clock"></i></span>
                                @elseif ($gift_card->shipping_status === 'pending')
                                    <span class="bg-warning text-white p-1"><span class="d-none">En cours</span><i
                                            class="fas fa-check-circle"></i></span>
                                @elseif ($gift_card->shipping_status === 'delivered')
                                    <span class="bg-success text-white p-1"><span class="d-none">Livrés</span><i
                                            class="fas fa-truck"></i></span>
                                @endif
                            </td>
                            <td>{{ date_format($gift_card->created_at, 'd F Y, H:i') }}</td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('dashboard.gift_card.show', ['id' => $gift_card->id]) }}"
                                        title="Voir plus">
                                        <i class="far fa-file-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
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
        let table = $('#editableTable').DataTable()

        function updateDropdown(buttonId, selection) {
            document.getElementById(buttonId).textContent = `Filtrer: ${selection}`;

            // Application du filtre selon le dropdown
            let col;
            let val = selection;

            // Identifie la colonne à filtrer selon le bouton
            if (buttonId === 'filter-customization') {
                col = 7; // Colonne de personnalisation
            } else if (buttonId === 'filter-used_status') {
                col = 6; // Colonne d'utilisation
            } else if (buttonId === 'filter-paid') {
                col = 8; // Colonne de status de paiement
            } else if (buttonId === 'filter-delivery_status') {
                col = 9; // Colonne de livraison
            }


            // Application du filtre avec DataTable
            if (val === "Tous") {
                table.column(col).search('').draw(); // Affiche toutes les valeurs
            } else {
                // Met en place le filtre correspondant
                table.column(col).search(val, true, false).draw();
            }
        }
    </script>
@endsection
