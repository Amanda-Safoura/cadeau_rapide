@extends('backoffice.layouts.main')
@section('title')
    Catégories
@endsection

@section('additionnal_css')
    <!-- Bootstrap DataTable -->
    <link rel="stylesheet" href="{{ asset('assets/backoffice/css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Add Partner Category</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <!-- Formulaire d'ajout-->
                                @include('backoffice.pages.partner_category.formAdd')
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="editableTable" class="display table table-striped table-bordered"
                                        cellspacing="0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Offcanvas d'édition -->
        @include('backoffice.pages.partner_category.formUpdate')
    </div>
@endsection

@section('additionnal_js')
    <!-- DataTable -->
    <script src="{{ asset('assets/backoffice/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/backoffice/js/plugin/datatables/dataTables.bootstrap5.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/backoffice/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- JQuery Validate Plugin -->
    <script src="{{ asset('assets/backoffice/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>

    <script>
        const FETCHDATAURL = "{{ route('dashboard.partner_category.fetch_all') }}"
    </script>

    <script>
        //#region Configuration générale

        const CURRENTURL = window.location.href
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

        //#endregion


        //#region Initialisation du DataTable

        // Initialisation du DataTable
        let table = $('#editableTable').DataTable({
            ajax: FETCHDATAURL, // Endpoint pour récupérer les données
            columns: [{
                    data: 'name'
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        return `
                        <div class="d-flex justify-content-between">
                            <button class="more-btn btn btn-sm btn-info" title="Voir plus">
                                <i class="far fa-file-alt"></i>
                            </button>
                            <button class="edit-btn btn btn-sm btn-warning" title="Modifier"
                                data-bs-toggle="offcanvas" data-bs-target="#editPartnerCategory" aria-controls="editPartnerCategory">
                                <i class="fas fa-edit"></i>
                            </button> 
                            <button class="delete-btn btn btn-sm btn-danger" title="Supprimer">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        <div>
                        `
                    }
                }
            ],
            language: {
                "url": "https://cdn.datatables.net/plug-ins/2.1.8/i18n/fr-FR.json" // Traduction en français
            }
        })
        //#endregion



        //#region Form d'ajout

        // Validation client du formulaire d'ajout
        $("#addPartnerCategoryForm").validate({
            rules: {
                name: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Le nom de la catégorie est obligatoire."
                }
            },
            // Ajouter dynamiquement une nouvelle ligne
            submitHandler: function(form) {
                $(form).find('div.alert').addClass('d-none')

                const formData = new FormData(form)
                let datas = {}

                // Display the key/value pairs
                for (const pair of formData.entries()) {
                    datas[pair[0]] = pair[1]
                }

                $.ajax({
                    url: $(form).attr('action'), // Endpoint pour ajouter les données
                    type: 'POST',
                    data: datas,
                    success: function(response) {
                        $(form).trigger('reset').find('div.alert-danger').addClass('d-none')
                        table.ajax.reload() // Recharger le DataTable
                        showNotif('success', '<strong>Success</strong>', 'fas fa-tags', response
                            .message)
                    },
                    error: function(response) {
                        for (const [key, value] of Object.entries(response.responseJSON[
                            'errors'])) {
                            $(`div[error-input="${key}"]`).html(value.join('<br>')).removeClass(
                                'd-none')
                        }
                    }
                })
            },
            // Quand il y a une/plusieurs erreur(s)
            highlight: function(element) {
                $(element).closest('.custom-form-input').find('div.alert').removeClass('d-none')
            },
            // Quand il n'y a aucune erreur
            unhighlight: function(element) {
                $(element).closest('.custom-form-input').find('div.alert').addClass('d-none')
            },
            errorPlacement: function(error, element) {
                $(element).closest('.custom-form-input').find('div.alert').text(error.text())
            }
        })
        //#endregion



        //#region Form d'édition

        // Ceci sert à suivre les mouvements utilisateurs sur la liste
        $('.table-responsive').on('click', '.more-btn, .edit-btn, .delete-btn', function() {
            // Récupérer la ligne à laquelle le bouton appartient
            rowData = table.row($(this).parents('tr')).data()
        })

        // Pré-remplir les champs
        $('.table-responsive').on('click', '.edit-btn', function() {

            $('#editPartnerCategoryForm').trigger('reset')
            $('#editPartnerCategoryForm div.alert').addClass('d-none')

            $("#editPartnerCategoryForm").find('input[name="name"]').val(rowData.name)
            $("#editPartnerCategoryForm").find('textarea[name="description"]').val(rowData.description)
        })

        // Validation client du formulaire d'édition
        $("#editPartnerCategoryForm").validate({
            rules: {
                name: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Le nom de la catégorie est obligatoire."
                }
            },
            // Ajouter dynamiquement une nouvelle ligne
            submitHandler: function(form) {
                $(form).find('div.alert').addClass('d-none')

                const formData = new FormData(form)
                let datas = {}

                // Display the key/value pairs
                for (const pair of formData.entries()) {
                    datas[pair[0]] = pair[1]
                }

                $.ajax({
                    url: CURRENTURL + `/${rowData.id}`, // Endpoint pour modifier l'instance choisie
                    type: 'PATCH',
                    data: datas,
                    success: function(response) {
                        $("#editPartnerCategory .btn-close").trigger('click')
                        table.ajax.reload() // Recharger le DataTable
                        showNotif('success', '<strong>Success</strong>', 'fas fa-user-plus',
                            response.message)
                    },
                    error: function(response) {
                        for (const [key, value] of Object.entries(response.responseJSON[
                            'errors'])) {
                            $(`div[error-input="${key}"]`).html(value.join('<br>')).removeClass(
                                'd-none')
                        }
                    }
                })
            },
            // Quand il y a une/plusieurs erreur(s)
            highlight: function(element) {
                $(element).closest('.custom-form-input').find('div.alert').removeClass('d-none')
            },
            // Quand il n'y a aucune erreur
            unhighlight: function(element) {
                $(element).closest('.custom-form-input').find('div.alert').addClass('d-none')
            },
            errorPlacement: function(error, element) {
                $(element).closest('.custom-form-input').find('div.alert').text(error.text())
            }
        })

        //#endregion
    </script>
@endsection
