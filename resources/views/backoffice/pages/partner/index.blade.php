@extends('backoffice.layouts.main')
@section('title')
    Partenaires
@endsection

@section('additionnal_css')
    <!-- Bootstrap DataTable -->
    <link rel="stylesheet" href="{{ asset('assets/backoffice/css/dataTables.bootstrap5.min.css') }}">

    <!-- Bootstrap File Input CSS -->
    <link rel="stylesheet" href="{{ asset('assets/backoffice/css/fileinput.min.css') }}" />
@endsection

@section('content')
    <div class="container mt-4">
        <div class="table-responsive">
            <table id="editableTable" class="display table table-striped table-bordered bg-white" cellspacing="0"
                style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Désignation</th>
                        <th>Valeur min. coupon</th>
                        <th>Commission(%)</th>
                        <th>Catégorie</th>
                        <th>Tel</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <!-- Offcanvas d'édition -->
        @include('backoffice.pages.partner.formUpdate')
    </div>
@endsection

@section('additionnal_js')
    <!-- DataTable -->
    <script src="{{ asset('assets/backoffice/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/backoffice/js/plugin/datatables/dataTables.bootstrap5.min.js') }}"></script>

    <!-- Bootstrap File Input JS -->
    <script src="{{ asset('assets/backoffice/js/plugin/bootstrap-fileinput/buffer.min.js') }}"></script>
    <script src="{{ asset('assets/backoffice/js/plugin/bootstrap-fileinput/filetype.min.js') }}"></script>
    <script src="{{ asset('assets/backoffice/js/plugin/bootstrap-fileinput/fileinput.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/backoffice/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- JQuery Validate Plugin -->
    <script src="{{ asset('assets/backoffice/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>

    <script>
        const FETCHDATAURL = "{{ route('dashboard.partner.fetch_all') }}"
        let partnerCategories = @js($partner_categories)
    </script>

    <script>
        //#region Configuration générale

        const CURRENTURL = window.location.href
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


        //#endregion



        //#region Initialisation du DataTable

        function initializeDataTable() {
            try {
                table = $('#editableTable').DataTable({
                    ajax: FETCHDATAURL, // Endpoint pour récupérer les données
                    columns: [{
                            data: 'id',
                            visible: false
                        },
                        {
                            data: 'name',
                            render: function(data, type, full, meta) {
                                let name = typeof(data) == 'string' ?
                                    (data.length > 40 ?
                                        data.slice(0, 40) + '...' :
                                        data
                                    ) :
                                    'N/A'

                                return `<div class="d-flex align-items-center">
                            <img src="${full['picture_1']}" alt="Avatar ${name}" class="rounded-circle me-3 partner_avatar" style="width: 50px; height: 50px;">
                            <span>${name}</span>
                        </div>`
                            }
                        },
                        {
                            data: 'min_amount'
                        },
                        {
                            data: 'commission_percent'
                        },
                        {
                            data: 'category_id',
                            render: function(data, type, full, meta) {
                                let current_partner = partnerCategories.find((category) => category?.id ==
                                    data)
                                return current_partner ? current_partner.name :
                                    'N/A'
                            }
                        },
                        {
                            data: 'phone_number'
                        },
                        {
                            data: 'email'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                return `
                            <div class="d-flex justify-content-between">
                                <a href="${full['page_link']}" target="_blank" class="more-btn btn btn-sm btn-info" title="Voir la page partenaire">
                                    <i class="far fa-file-alt"></i>
                                </a>
                                <button class="edit-btn btn btn-sm btn-warning" title="Modifier"
                                    data-bs-toggle="offcanvas" data-bs-target="#editPartner" aria-controls="editPartner">
                                        <i class="fas fa-edit"></i>
                                </button> 
                                ${ !full['suspended']
                                ? `<button class="suspended-btn btn btn-sm btn-danger" title="Suspendre ce partenaire"
                                        data-id="${full['id']}">
                                        <i class="fas fa-user-slash"></i>
                                    </button>`
                                : `<button class="suspended-btn btn btn-sm btn-primary" title="Rétablir ce partenaire"
                                        data-id="${full['id']}">
                                        <i class="fas fa-user"></i>
                                    </button>` }
                            </div>
                        `
                            }
                        }
                    ],
                    language: {
                        "url": "https://cdn.datatables.net/plug-ins/2.1.8/i18n/fr-FR.json" // Traduction en français
                    }
                })

            } catch {
                $('#editableTable tbody').html(`
            <tr>
                <td colspan="11">
                    <div class="text-black">Erreur lors de l'initialisation du tableau : ${error}</div>
                </td>
            </tr>
            `)
            }
        }
        initializeDataTable()
        //#endregion


        //#region Form d'édition

        $('.table-responsive').on('click', '.edit-btn, .delete-btn', function() {
            // Récupérer la ligne à laquelle le bouton appartient
            rowData = table.row($(this).parents('tr')).data()
        })

        // Pré-remplir les champs
        $('.table-responsive').on('click', '.edit-btn', function() {

            $('#editPartnerForm').trigger('reset')
            $('#editPartnerForm div.alert').addClass('d-none')


            // Affiche l'image de prévisualisation
            $('#pictureContainer img').attr('src', rowData.picture_1)

            $('#editPartnerForm').find('input[name="name"]').val(rowData.name)
            $('#editPartnerForm').find('input[name="short_description"]').val(rowData.short_description)
            $('#editPartnerForm').find('select[name="category_id"]').val(rowData.category_id)
            $('#editPartnerForm').find('textarea[name="description"]').val(rowData.description)

            let offers = ''
            rowData.offers.split('--separator--').forEach(element => {
                offers +=
                    `${element}
`
            })
            $('#editPartnerForm').find('textarea[name="offers"]').val(offers)
            $('#editPartnerForm').find('input[name="tags"]').val(rowData.tags)

            $('#editPartnerForm').find('input[name="min_amount"]').val(rowData.min_amount)
            $('#editPartnerForm').find('input[name="commission_percent"]').val(rowData.commission_percent)
            $('#editPartnerForm').find('input[name="phone_number"]').val(rowData.phone_number)
            $('#editPartnerForm').find('input[name="email"]').val(rowData.email)
            $('#editPartnerForm').find('input[name="adress"]').val(rowData.adress)

        })

        // Validation client du formulaire d'édition
        $("#editPartnerForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 5
                },
                description: {
                    required: true
                },
                offers: {
                    required: true
                },
                category_id: {
                    required: true
                },
                phone_number: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                min_amount: {
                    required: true,
                    min: 10000
                },
                commission_percent: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: 'Le nom du partenaire est obligatoire.',
                    minlength: 'Le nom du partenaire doit comporter minimum 5 caratères.'
                },
                description: {
                    required: 'Le texte descriptif du partenaire est obligatoire.'
                },
                offers: {
                    required: 'Les offres ou services du partenaire sont obligatoire.'
                },
                category_id: {
                    required: 'La catégorie du partenaire est obligatoire.',
                },
                phone_number: {
                    required: 'Le numéro de téléphone est obligatoire.',
                },
                email: {
                    required: 'L\'adresse mail du partenaire est obligatoire.',
                    email: 'Veuillez saisir une adresse mail valide.'
                },
                min_amount: {
                    required: 'Le montant minimal des coupons est obligatoire.',
                    min: 'Le montant minimal des coupons doit être supérieur à 10 000 XOF.',
                },
                commission_percent: {
                    required: 'Le pourcentage de commission est obligatoire.',
                }
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
                        $("#editPartner .btn-close").trigger('click')
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


        $('.table-responsive').on('click', '.suspended-btn', function() {
            let $button = $(this); // Référence au bouton cliqué
            let itemId = $button.data(
                'id'); // ID de l'élément (doit être défini en attribut data-id dans le bouton)
            let isSuspended = $button.hasClass('suspended'); // Vérifier l'état actuel

            // Envoi de la requête AJAX
            $.ajax({
                url: "{{ route('dashboard.partner.suspense') }}", // Remplacez par le chemin de votre route
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF token pour sécuriser la requête
                    id: itemId,
                    suspended: !isSuspended // Nouveau statut de lecture (inverse de l'actuel)
                },
                success: function(response) {
                    // Mise à jour de l'interface utilisateur en fonction du nouveau statut
                    if (!isSuspended) {
                        $button.addClass('suspended').attr('title', 'Rétablir ce partenaire').addClass('btn-primary').removeClass('btn-danger')
                            .html('<i class="fas fa-user"></i>');
                    } else {
                        $button.removeClass('suspended').attr('title', 'Suspendre ce partenaire').removeClass('btn-primary').addClass('btn-danger')
                            .html('<i class="fas fa-user-slash"></i>');
                    }
                },
                error: function(xhr, status, error) {}
            });
        });
        //#endregion
    </script>
@endsection
