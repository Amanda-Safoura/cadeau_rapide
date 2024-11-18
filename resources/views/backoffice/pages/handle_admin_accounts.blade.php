@extends('backoffice.layouts.main')

@section('title', 'Gestion des Comptes Admins')

@section('additionnal_css')
    <link rel="stylesheet" href="{{ asset('assets/backoffice/css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="container mt-4">
                <button class="btn btn-primary mb-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFormAdd"
                    aria-controls="offcanvasFormAdd">Créer un nouvel Admin&ensp;<i class="fa fa-plus"></i></button>
                <div class="table-responsive">
                    <table id="editableTable" class="display table table-striped table-bordered" cellspacing="0"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Status du compte</th>
                                <th>Membre depuis</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <!-- Offcanvas -->
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasFormAdd"
                    aria-labelledby="offcanvasFormAddLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasFormAddLabel">Formulaire de Création</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">

                        <p class="h6 mb-4 mt-3">Ce formulaire est dédié à la création de comptes Administrateurs</p>

                        <form method="POST" action="{{ route('dashboard.admin_accounts.store') }}" id="formCreateAdmin">
                            @csrf
                            <div class="custom-form-input mb-3">
                                <label for="nameCreate" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nameCreate" name="name"
                                    placeholder="Entrez son nom">
                                <div class="alert alert-danger d-none" error-input="name"></div>
                            </div>
                            <div class="custom-form-input mb-3">
                                <label for="emailCreate" class="form-label">Email</label>
                                <input type="email" class="form-control" id="emailCreate" name="email"
                                    placeholder="Entrez son adresse mail">
                                <div class="alert alert-danger d-none" error-input="email"></div>
                            </div>

                            <button type="submit" id="addRow"
                                class="w-100 btn btn-primary btn-rounded mt-3">Créer</button>
                        </form>
                    </div>
                </div>


                <!-- Offcanvas -->
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasFormEdit"
                    aria-labelledby="offcanvasFormEditLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasFormEditLabel">Formulaire de Modification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">

                        <p class="h6 mb-4 mt-3">Ce formulaire est dédié à la modification de comptes Administrateurs</p>

                        <form method="POST" id="formUpdateAdmin">
                            @csrf

                            <div class="custom-form-input mb-3">
                                <label for="nameEdit" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nameEdit" name="name"
                                    placeholder="Entrez son nom">
                                <div class="alert alert-danger d-none" error-input="name"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" id="emailEdit" class="form-control" readonly>
                                <div class="alert alert-danger d-none" error-input="email"></div>
                            </div>

                            <div class="custom-form-input mb-3">
                                <label class="form-label">Suspendre ce compte:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="suspended" id="suspend-oui"
                                        value="true" />
                                    <label class="form-check-label" for="suspend-oui">Oui</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="suspended" id="suspend-non"
                                        value="false" />
                                    <label class="form-check-label" for="suspend-non">Non</label>
                                </div>
                                <div class="alert alert-danger d-none" error-input="suspended"></div>
                            </div>


                            <button type="submit" class="w-100 btn btn-primary btn-rounded mt-3">Créer</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modale de confirmation -->
            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Contenu dynamique rempli par JavaScript -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="cancelAction"
                                data-bs-dismiss="modal">Annuler</button>
                            <button type="button" class="btn btn-primary" id="confirmAction">Confirmer</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('additionnal_js')
    <script src="{{ asset('assets/backoffice/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/backoffice/js/plugin/datatables/dataTables.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('assets/backoffice/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/backoffice/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <script>
        const FETCHDATAURL = "{{ route('dashboard.admin_accounts.fetch_all') }}"
        const CURRENTURL = "{{ route('dashboard.admin_accounts.index') }}"
        let rowData = {}


        // fonction générique pour gérer les notifications
        function showNotif(type = 'success', title = '<strong>Success!</strong>', icon = 'fa fa-bell', message =
            'Your password has been successfully changed.') {

            $.notify({
                title,
                icon,
                message
            }, {
                type,
                allow_dismiss: true,
                delay: 3000,
                placement: {
                    from: "top",
                    align: "left"
                },
                animate: {
                    enter: 'animated fadeInLeft',
                    exit: 'animated fadeOutLeft'
                }
            })

        }

        // Initialisation du DataTable
        var table = $('#editableTable').DataTable({
            ajax: FETCHDATAURL, // Endpoint pour récupérer les données
            columns: [{
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'suspended',
                    render: function(data, type, full, meta) {
                        return data == "1" ? '<span class="badge bg-warning">Suspendu</span>' :
                            '<span class="badge bg-success">Actif</span>'
                    }
                },
                {
                    data: 'first_login',
                    render: function(data, type, full, meta) {
                        return data ? data :
                            'N/A'
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        return `
                        <button class="edit-btn btn btn-sm btn-warning" title="Modifier" 
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasFormEdit"
                            aria-controls="offcanvasFormEdit">
                            <i class="fas fa-edit"></i>
                        </button> 

                        <button class="toggle-suspend-btn btn btn-sm ${full['suspended'] ? 'btn-success' : 'btn-danger'}" 
                            title="${full['suspended'] ? 'Réactiver' : 'Suspendre'}">
                            <i class="fas ${full['suspended'] ? 'fa-unlock' : 'fa-lock'}"></i>
                        </button>
                    `
                    }
                }
            ],
            language: {
                "url": "https://cdn.datatables.net/plug-ins/2.1.8/i18n/fr-FR.json" // Traduction en français
            }
        });

        // Affichage des erreurs dans les champs
        function displayFormErrors(errors) {
            // Réinitialiser toutes les erreurs précédentes
            $('div[error-input]').html('').addClass('d-none');

            // Parcourir les erreurs et les afficher dans la div correspondante
            for (let field in errors) {
                const errorDiv = $(`div[error-input="${field}"]`);
                errorDiv.removeClass('d-none').html(errors[field].join('<br>'));
            }
        }

        $('#formCreateAdmin').on('submit', function(e) {
            e.preventDefault();

            const formData = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    showNotif('success', '<strong>Success</strong>', 'fa fa-user', response
                        .message)
                    $('#offcanvasFormAdd .btn-close').trigger('click'); // Fermer le formulaire
                    table.ajax.reload(); // Recharger les données du tableau
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        displayFormErrors(xhr.responseJSON.errors);
                    } else {

                        showNotif('danger', '<strong>Error</strong>', 'fa fa-times', `
                    Une erreur est survenue lors de la mise à jour. Veuillez réessayer.
                    `)
                    }
                }
            });
        });


        $('.table-responsive').on('click', '.edit-btn', function() {
            // Récupérer la ligne à laquelle le bouton appartient
            rowData = table.row($(this).parents('tr')).data()
        })


        // Pré-remplir les champs
        $('.table-responsive').on('click', '.edit-btn', function() {
            const currentRow = table.row($(this).parents('tr')).data();

            // Réinitialiser le formulaire et masquer les erreurs
            $('#formUpdateAdmin').trigger('reset');
            $('#formUpdateAdmin div.alert').addClass('d-none');

            // Pré-remplir les champs texte
            $('#formUpdateAdmin').find('input[name="name"]').val(currentRow.name);
            $('#formUpdateAdmin').find('input#emailEdit').val(currentRow.email);

            // Cocher la radio correspondant au statut "suspended"
            if (currentRow.suspended) {
                $('#formUpdateAdmin').find('input[name="suspended"][value="true"]').prop('checked', true);
            } else {
                $('#formUpdateAdmin').find('input[name="suspended"][value="false"]').prop('checked', true);
            }
        });


        $('#formUpdateAdmin').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();


            $.ajax({
                url: `${CURRENTURL}/${rowData.id}`,
                type: 'PATCH',
                data: formData,
                success: function(response) {
                    $('#offcanvasFormEdit .btn-close').trigger('click'); // Fermer le offcanvas
                    showNotif('success', '<strong>Success</strong>', 'fa fa-user', response
                        .message)
                    table.ajax.reload(); // Recharger les données du tableau
                },
                error: function(xhr, status, error) {
                    showNotif('danger', '<strong>Error</strong>', 'fa fa-times', `
                    Une erreur est survenue lors de la mise à jour. Veuillez réessayer.
                    Erreur: ${xhr.responseText}
                    `)
                }
            });
        });

        $('#editableTable').on('click', '.toggle-suspend-btn', function() {
            const rowData = table.row($(this).parents('tr')).data();
            const newState = rowData.suspended ? 'false' : 'true'; // Inverser l'état actuel

            // Ouvrir le modal de confirmation
            $('#confirmationModal').modal('show');

            // Personnaliser le contenu du modal
            $('#confirmationModal .modal-title').text(rowData.suspended ? 'Réactivation' : 'Suspension');
            $('#confirmationModal .modal-body').html(
                `<p>Voulez-vous vraiment <strong>${rowData.suspended ? 'réactiver' : 'suspendre'}</strong> le compte de <strong>${rowData.name}</strong> ?</p>`
            );

            // Gérer l'action au clic sur le bouton "Confirmer"
            $('#confirmAction').off('click').on('click', function() {
                $.ajax({
                    url: "{{ route('dashboard.admin_accounts.suspense') }}", // Route backend
                    type: 'POST',
                    data: {
                        id: rowData.id,
                        suspended: newState,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Modifier le contenu du modal pour indiquer le succès
                        $('#confirmationModal .modal-title').text('Succès');
                        $('#confirmationModal .modal-body').html(
                            `Le compte de <strong>${rowData.name}</strong> a été ${newState === 'true' ? 'suspendu' : 'réactivé'} avec succès.`
                        );

                        // Désactiver le bouton "Confirmer" après succès
                        $('#confirmAction').hide();
                        $('#cancelAction').text('Fermer');

                        // Recharger le DataTable après un délai pour laisser voir le message
                        setTimeout(() => {
                            $('#confirmationModal').modal('hide');
                            table.ajax.reload();
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        // Modifier le contenu du modal pour indiquer une erreur
                        $('#confirmationModal .modal-title').text('Erreur');
                        $('#confirmationModal .modal-body').html(
                            `Une erreur est survenue lors de la mise à jour. Veuillez réessayer.
                            <br><br><p class="text-danger">Erreur: <strong>${xhr.responseText}</strong></p>`
                        );

                        // Désactiver le bouton "Confirmer" après une erreur
                        $('#confirmAction').hide();
                        $('#cancelAction').text('Fermer');
                    }
                });
            });

            // Réinitialiser le modal lors de sa fermeture
            $('#confirmationModal').on('hidden.bs.modal', function() {
                $('#confirmAction').show(); // Réactiver le bouton "Confirmer"
                $('#cancelAction').text('Annuler'); // Remettre le texte par défaut
            });
        });
    </script>
@endsection
