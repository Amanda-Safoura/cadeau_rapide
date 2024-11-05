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
                <button class="btn-primary custom-dropdown-toggle" type="button" id="filter-paid">
                    Filtrer par statut de paiement
                </button>
                <ul class="custom-dropdown-menu">
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-paid', 'Payées')">Payées</a>
                    </li>
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-paid', 'Non Payées')">Non
                            Payées</a></li>
                    <li><a class="custom-dropdown-item" href="javascript:void(0);"
                            onclick="updateDropdown('filter-paid', 'Tous')">Tous</a>
                    </li>
                </ul>
            </div>

            <div class="custom-dropdown">
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
                        <th>Client</th>
                        <th>Bénéficiaire</th>
                        <th>Adresse de livraison</th>
                        <th>Frais de livraison</th>
                        <th>Date de livraison</th>
                        <th>Montant</th>
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
                            <td>{{ $gift_card->client_name }}</td>
                            <td>
                                @if ($gift_card->is_client_beneficiary)
                                    Le client lui-même
                                @else
                                    {{ $gift_card->beneficiary_name }}
                                @endif
                            </td>
                            <td>{{ $gift_card->delivery_address }} </td>
                            <td>{{ $gift_card->shipping_price }} </td>
                            <td>{{ $gift_card->delivery_date->format('d F Y') }} </td>
                            <td>{{ $gift_card->amount }}</td>
                            <td class="text-center">
                                @if ($gift_card->is_customized)
                                    <span class="bg-success text-white p-1"><span class="d-none">Personnalisés</span><i
                                            class="fas fa-check"></i></span>
                                @else
                                    <span class="bg-danger text-white px-2 py-1"><span class="d-none">Standards</span><i
                                            class="fas fa-times"></i></span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($gift_card->paymentInfo->status === 'SUCCESSFUL')
                                    <span class="bg-success text-white p-1"><span class="d-none">Payées</span><i
                                            class="fas fa-check"></i></span>
                                @elseif($gift_card->paymentInfo->status === 'FAILED')
                                    <span class="bg-danger text-white px-2 py-1"><span class="d-none">Non Payées</span><i
                                            class="fas fa-times"></i></span>
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
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-primary btn-sm me-3"
                                        href="{{ route('dashboard.gift_card.show', ['id' => $gift_card->id]) }}"
                                        title="Voir plus">
                                        <i class="far fa-file-alt"></i>
                                    </a>
                                    <button class="btn btn-secondary btn-sm me-3 manage-status"
                                        data-id="{{ $gift_card->id }}" data-status="{{ $gift_card->shipping_status }}"
                                        title="Gérer le statut de livraison">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal pour gestion de statut -->
        <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel">Modifier le statut de livraison</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Barre de progression -->
                        <div class="progress mb-3" style="height: 8px;">
                            <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%;"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <!-- Étapes de statut avec icônes -->
                        <div class="d-flex justify-content-between text-muted">
                            <span id="step1" class="fw-bold">
                                <i class="fas fa-clock"></i>
                                En attente de traitement
                            </span>
                            <span id="step2"><i class="fas fa-check-circle"></i> En cours</span>
                            <span id="step3"><i class="fas fa-truck"></i> Livrée</span>
                        </div>

                        <!-- Range Slider pour changer le statut -->
                        <input type="range" id="statusSlider" class="form-range mt-4" min="0" max="2"
                            step="1">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" id="saveStatus" class="btn btn-primary">Enregistrer le statut</button>
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
            } else if (buttonId === 'filter-delivery_status') {
                col = 8; // Colonne de renseignement sur le statut de livraison
            }

            // Application du filtre avec DataTable
            if (val === "Tous") {
                table.column(col).search('').draw(); // Affiche toutes les valeurs
            } else {
                if (buttonId === 'filter-paid') table.column(col).search('^' + val + '$', true, false).draw();
                // Met en place le filtre correspondant
                else table.column(col).search(val, true, false).draw();
            }
        }


        const iconSteps = [`<span class="bg-info text-white p-1"><span class="d-none">En attente de
                traitement</span><i class="fas fa-clock"></i></span>`,
            `<span class="bg-warning text-white p-1"><span class="d-none">En cours</span><i
                class="fas fa-check-circle"></i></span>`,
            `<span class="bg-success text-white p-1"><span class="d-none">Livrés</span><i
                class="fas fa-truck"></i></span>`
        ];

        const steps = ['awaiting processing', 'pending', 'delivered']

        const progressValues = ["33%", "66%", "100%"];

        // Ouvrir le modal et initialiser le slider selon le statut actuel
        $('.manage-status').on('click', function() {
            const orderId = $(this).data('id');
            const currentStatus = $(this).data('status');

            // Met à jour le modal avec l'ID de la commande
            $('#statusModalLabel').text(`Modifier le statut de la commande #${orderId}`);
            $('#statusSlider').val(currentStatus);
            updateProgressBar(currentStatus);

            // Sauvegarde l'ID de la commande dans un attribut du bouton Enregistrer
            $('#saveStatus').data('orderId', orderId);

            // Ouvrir le modal
            $('#statusModal').modal('show');
        });

        function updateProgressBar(value) {
            const progressValues = ["33%", "66%", "100%"];
            const colors = ["bg-primary", "bg-warning", "bg-success"];

            // Retire les classes de couleur précédentes et ajoute la nouvelle couleur
            $('#progressBar')
                .removeClass("bg-primary bg-warning bg-success")
                .addClass(colors[value])
                .css('width', progressValues[value]);

            // Mise à jour des étapes avec des styles gras pour l'étape active
            $('#step1').toggleClass('fw-bold', value == 0);
            $('#step2').toggleClass('fw-bold', value == 1);
            $('#step3').toggleClass('fw-bold', value == 2);
        }


        // Slider change
        $('#statusSlider').on('input', function() {
            const value = $(this).val();
            updateProgressBar(value);
        });

        // Enregistrer le statut mis à jour
        $('#saveStatus').on('click', function() {
            const newStatus = $('#statusSlider').val();
            const orderId = $(this).data('orderId');
            const statusIcon = iconSteps[newStatus];
            const status = steps[newStatus];

            $.ajax({
                type: "get",
                url: "{{ route('dashboard.gift_card.change_delivery_status') }}",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    orderId,
                    newStatus: status
                },
                success: function(response) {
                    // Met à jour le tableau
                    $(`button[data-id="${orderId}"]`).closest('tr').find('td:nth-child(9)').html(
                        statusIcon);

                }
            });
            // Fermer le modal
            $('#statusModal').modal('hide');
        });
    </script>
@endsection
