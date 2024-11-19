@extends('backoffice.layouts.main')
@section('title')
    Adresses de livraison
@endsection

@section('additionnal_css')
    <!-- Bootstrap DataTable -->
    <link rel="stylesheet" href="{{ asset('assets/backoffice/css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
    <div class="container mt-4">
        <div class="table-responsive">
            <table id="editableTable" class="display table table-striped table-bordered bg-white" cellspacing="0"
                style="width:100%">
                <thead>
                    <tr>
                        <th>Zone</th>
                        <th>Prix de la Statut de livraison</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <!-- Offcanvas d'édition -->
        @include('backoffice.pages.shipping.formUpdate')

        <!-- Modal de suppression -->
        @include('backoffice.pages.shipping.deleteModal')

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
        const CURRENTURL = window.location.href
        const FETCHDATAURL = "{{ route('dashboard.shipping.fetch_all') }}"
        let rowData = {}
        let table = null


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

        table = $('#editableTable').DataTable({
            ajax: FETCHDATAURL, // Endpoint pour récupérer les données
            columns: [{
                    data: 'zone'
                },
                {
                    data: 'price'
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        return `
                            <div class="d-flex justify-content-center">
                                <button class="edit-btn btn btn-sm btn-warning me-2" title="Modifier"
                                   data-bs-toggle="offcanvas" data-bs-target="#editShipping" aria-controls="editShipping">
                                    <i class="fas fa-edit"></i>
                                </button> 
                                <button class="delete-btn btn btn-sm btn-danger" title="Supprimer"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        `
                    }
                }
            ],
            language: {
                "url": "https://cdn.datatables.net/plug-ins/2.1.8/i18n/fr-FR.json" // Traduction en français
            }
        })


        $('.table-responsive').on('click', '.edit-btn, .delete-btn', function() {
            // Récupérer la ligne à laquelle le bouton appartient
            rowData = table.row($(this).parents('tr')).data()
        })

        // Pré-remplir les champs
        $('.table-responsive').on('click', '.edit-btn', function() {

            $('#editShippingForm').trigger('reset')
            $('#editShippingForm div.alert').addClass('d-none')

            $('#editShippingForm').find('input[name="zone"]').val(rowData.zone)
            $('#editShippingForm').find('input[name="price"]').val(rowData.price)

        })

        // Validation client du formulaire d'édition
        $("#editShippingForm").validate({
            rules: {
                zone: {
                    required: true,
                    maxlength: 255
                },
                price: {
                    required: true
                },
            },
            messages: {
                zone: {
                    required: "L'adresse d'arrivée est obligatoire",
                    maxlength: "L'énoncé de la zone applicable ne doit pas dépasser les 255 caractères",
                },
                price: {
                    required: "Le prix de la livraison est obligatoire"
                },
            },
            // Ajouter dynamiquement une nouvelle ligne
            submitHandler: function(form) {
                $(form).find('div.alert').addClass('d-none')

                const formData = new FormData(form)

                $.ajax({
                    url: CURRENTURL + `/${rowData.id}`, // Endpoint pour modifier l'instance choisie
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $("#editShipping .btn-close").trigger('click')
                        table.ajax.reload() // Recharger le DataTable
                        showNotif('success', '<strong>Success</strong>', 'fa fa-user', response
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

        $('#confirmDelete').on('click', function() {
            $.ajax({
                url: CURRENTURL + `/${rowData.id}`, // Endpoint pour modifier l'instance choisie
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $("#deleteModal .btn-close").trigger('click')
                    table.ajax.reload() // Recharger le DataTable
                    showNotif('success', '<strong>Success</strong>', 'fa fa-user', response
                        .message)
                },
                error: function(response) {
                    $("#deleteModal .btn-close").trigger('click')
                    showNotif('danger', '<strong>Error</strong>', 'fa fa-user', response.responseJSON
                        .message)
                }
            })
        })
    </script>
@endsection
