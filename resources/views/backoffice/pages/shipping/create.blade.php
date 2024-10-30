@extends('backoffice.layouts.main')
@section('title')
    Ajouter une Adresse de livraison
@endsection

@section('content')
    <div class="container px-5">
        <h5 class="text-center mb-5 h3">Formulaire de Création</h5>

        <form method="POST" action="{{ route('dashboard.shippings.store') }}" id="addShippingForm">
            @csrf

            <div class="mb-3 custom-form-input">
                <label for="zoneCreate" class="form-label">Zone applicable <span class="text-danger">*</span></label>
                <input type="text" id="zoneCreate" class="form-control" name="zone"
                    placeholder="Ex: Cotonou Akpakpa, Cotonou...">
                <div class="alert alert-danger" error-input="zone"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="priceCreate" class="form-label">Prix de la livraison <span class="text-danger">*</span></label>
                <input type="number" id="priceCreate" class="form-control" name="price" placeholder="1000">
                <div class="alert alert-danger" error-input="price"></div>
            </div>


            <div class="alert alert-danger" error-input="general"></div>

            <button type="submit" class="w-100 btn btn-primary btn-rounded mt-3">Créer</button>
        </form>

    </div>
@endsection


@section('additionnal_js')
    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/backoffice/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- JQuery Validate Plugin -->
    <script src="{{ asset('assets/backoffice/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>

    <script>
        $(function() {

            // Reset du formulaire
            resetFormAdd()


            // Validation client du formulaire d'ajout
            $("#addShippingForm").validate({
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
                        url: $(form).attr('action'), // Endpoint pour ajouter les données
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            showNotif('success', '<strong>Success</strong>',
                                'fa fa-user-plus', response.message)
                            // Reset du form d'ajout
                            resetFormAdd()
                        },
                        error: function(response) {
                            for (const [key, value] of Object.entries(response.responseJSON[
                                    'errors'])) {
                                $(`div[error-input="${key}"]`).html(value.join('<br>'))
                                    .removeClass('d-none')
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
        })



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

        function resetFormAdd() {
            $('#addShippingForm div.alert').addClass('d-none')
            $('#addShippingForm').trigger('reset')
        }
    </script>
@endsection
