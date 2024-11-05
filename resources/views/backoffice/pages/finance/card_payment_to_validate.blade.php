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
            <div class="custom-dropdown me-3">
                <button class="custom-dropdown-toggle btn-primary" id="filter-paid" type="button">
                    Filtrer par statut de livraison
                </button>
                <ul class="custom-dropdown-menu">
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-paid', 'Approuvés')">Approuvés</a></li>
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-paid', 'Rejettés')">Rejettés</a></li>
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-paid', 'Tous')">Tous</a>
                    </li>
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
                        <th>Partenaire</th>
                        <th>Montant</th>
                        <th>Somme totale payé</th>
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
                            <td>{{ $gift_card->partner->name }} </td>
                            <td>{{ $gift_card->amount }}</td>
                            <td>{{ $gift_card->total_amount }}</td>
                            <td>
                                @if ($gift_card->paymentInfo->status === 'SUCCESSFUL')
                                    <span class="bg-success text-white p-1">
                                        <span class="d-none">Approuvés</span>
                                        <i class="fas fa-check"></i>
                                    </span>
                                @elseif ($gift_card->paymentInfo->status === 'FAILED')
                                    <span class="bg-danger text-white px-2 py-1">
                                        <span class="d-none">Rejettés</span>
                                        <i class="fas fa-times"></i>
                                    </span>
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
                                    <button @class([
                                        'btn btn-success text-white p-1 change_payment_status' => true,
                                        'disabled' => $gift_card->paymentInfo->status === 'SUCCESSFUL',
                                    ]) type="button" data-id="{{ $gift_card->id }}"
                                        title="Valider le paiement">
                                        <i class="fas fa-check"></i>
                                    </button>

                                    <button @class([
                                        'btn btn-danger text-white px-2 py-1 change_payment_status' => true,
                                        'disabled' => $gift_card->paymentInfo->status === 'FAILED',
                                    ]) type="button" data-id="{{ $gift_card->id }}"
                                        title="Rejeter le paiement">
                                        <i class="fas fa-times"></i>
                                    </button>
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
                col = 5; // Colonne de status de paiement
            }

            // Application du filtre avec DataTable
            if (val === "Tous") {
                table.column(col).search('').draw(); // Affiche toutes les valeurs
            } else {
                // Met en place le filtre correspondant
                table.column(col).search(val).draw(); // Supprime les caractères ^ et $ pour un filtrage flexible
            }
        }


        $('.change_payment_status').on('click', function() {
            let newStatus = null;
            let self = $(this); // Garde une référence au bouton déclencheur

            if (self.hasClass('btn-success')) newStatus = "SUCCESSFUL";
            if (self.hasClass('btn-danger')) newStatus = "FAILED";

            $.ajax({
                type: "get",
                url: "{{ route('dashboard.finance.change_payment_status') }}",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    gift_card_id: self.attr('data-id'),
                    newStatus
                },
                success: function(response) {
                    // Désactiver le bouton actuel et réactiver le bouton opposé
                    self.addClass('disabled').siblings('button.change_payment_status').removeClass(
                        'disabled');

                    // Mettre à jour la ligne dans DataTable
                    let rowData = table.row(self.closest('tr')).data();
                    rowData[5] = newStatus === "SUCCESSFUL" ?
                        '<span class="bg-success text-white p-1"><span class="d-none">Approuvés</span><i class="fas fa-check"></i></span>' :
                        '<span class="bg-danger text-white p-1"><span class="d-none">Rejettés</span><i class="fas fa-times"></i></span>'; // Met à jour la colonne de statut
                    table.row(self.closest('tr')).data(rowData).draw(); // Redessiner le tableau
                }
            });
        });
    </script>
@endsection
