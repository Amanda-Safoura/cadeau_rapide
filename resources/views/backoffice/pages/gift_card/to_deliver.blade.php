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
            <div class="dropdown me-3">
                <button class="btn btn-primary dropdown-toggle" type="button" id="filter-paid" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Filtrer par type de livraison
                </button>
                <ul class="dropdown-menu" aria-labelledby="filter-paid">
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown('filter-paid', 'Payées')">Payées</a>
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown('filter-paid', 'Non Payées')">Non
                            Payées</a></li>
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown('filter-paid', 'Tous')">Tous</a>
                    </li>
                </ul>
            </div>

            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="filter-customization"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Filtrer par demande de personnalisation
                </button>
                <ul class="dropdown-menu" aria-labelledby="filter-customization">
                    <li><a class="dropdown-item" href="#"
                            onclick="updateDropdown('filter-customization', 'Personnalisés')">Personnalisés</a></li>
                    <li><a class="dropdown-item" href="#"
                            onclick="updateDropdown('filter-customization', 'Standards')">Standards</a></li>
                    <li><a class="dropdown-item" href="#"
                            onclick="updateDropdown('filter-customization', 'Tous')">Tous</a></li>
                </ul>
            </div>
        </div>

        <div class="table-responsive">
            <table id="editableTable" class="display table table-striped table-bordered bg-white" cellspacing="0"
                style="width:100%">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Bénéficiaire</th>
                        <th>Adresse de livraison</th>
                        <th>Frais de livraison</th>
                        <th>Date de livraison</th>
                        <th>Montant</th>
                        <th>Customisé</th>
                        <th>Payé</th>
                        <th>Date de commande</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $gift_card)
                        <tr>
                            <td>{{ $gift_card->client_name }}</td>
                            <td>
                                @if ($gift_card->is_client_beneficiary)
                                    Le client lui-même
                                @else
                                    {{ $gift_card->beneficiary_name }}
                                @endif
                            </td>
                            <td>{{ $gift_card->delivery_adress }} </td>
                            <td>{{ $gift_card->shipping->price }} </td>
                            <td>{{ $gift_card->delivery_date->format('d F Y') }} </td>
                            <td>{{ $gift_card->amount }}</td>
                            <td class=" text-center">
                                @if ($gift_card->is_customized)
                                    <span class="bg-success text-white p-1"><span class="d-none">Personnalisés</span><i
                                            class="fas fa-check"></i></span>
                                @else
                                    <span class="bg-danger text-white px-2 py-1"><span class="d-none">Standards</span><i
                                            class="fas fa-times"></i></span>
                                @endif
                            </td>
                            <td class=" text-center">
                                @if ($gift_card->requires_delivery)
                                    <span class="bg-success text-white p-1"><span class="d-none">Payées</span><i
                                            class="fas fa-check"></i></span>
                                @else
                                    <span class="bg-danger text-white px-2 py-1"><span class="d-none">Non Payées</span><i
                                            class="fas fa-times"></i></span>
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
            if (buttonId === 'filter-paid') {
                col = 7; // Colonne de renseignement sur le paiement
            } else if (buttonId === 'filter-customization') {
                col = 6; // Colonne de personnalisation
            }

            // Application du filtre avec DataTable
            if (val === "Tous") {
                table.column(col).search('').draw(); // Affiche toutes les valeurs
            } else {
                // Met en place le filtre correspondant
                table.column(col).search('^' + val + '$', true, false).draw();
            }
        }
    </script>
@endsection
