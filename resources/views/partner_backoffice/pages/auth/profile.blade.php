@extends('partner_backoffice.layouts.main')
@section('title')
    Ajouter un Partenaire
@endsection

@section('additionnal_css')
    <!-- Bootstrap File Input CSS -->
    <link rel="stylesheet" href="{{ asset('assets/backoffice/css/fileinput.min.css') }}" />
@endsection

@section('content')
    <div class="container px-5">
        <h5 class="text-center mb-5 h3">Profile <a href="{{ route('client.partner.show', ['slug' => $partner->slug]) }}"
                class="btn btn-link ms-3"></a></h5>

        <form method="POST" action="{{ route('partner.panel.profile.update') }}" id="updateProfile"
            enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="partner" value="{{ $partner->id }}">
            <div class="mb-3 custom-form-input">
                <label for="nameEdit" class="form-label">Nom Partenaire <span class="text-danger">*</span></label>
                <input type="text" id="nameEdit" class="form-control" name="name"
                    value="{{ old('name', $partner->name) }}" placeholder="Entrez son nom">
                <div class="alert alert-danger" error-input="name"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="picture_1Edit" class="form-label">Photo/Logo Partenaire <span
                        class="text-danger">*</span></label>
                <input id="picture_1Edit" name="picture_1" type="file" class="file" data-show-preview="false"
                    data-msg-placeholder="Sélectionner l'image...">

                <div class="alert alert-danger" error-input="picture_1"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="picture_2Edit" class="form-label">Photo Service/Offre 1 <span
                        class="text-danger">*</span></label>
                <input id="picture_2Edit" name="picture_2" type="file" class="file" data-show-preview="false"
                    data-msg-placeholder="Sélectionner l'image...">

                <div class="alert alert-danger" error-input="picture_2"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="picture_3Edit" class="form-label">Photo Service/Offre 2</label>
                <input id="picture_3Edit" name="picture_3" type="file" class="file" data-show-preview="false"
                    data-msg-placeholder="Sélectionner l'image...">

                <div class="alert alert-danger" error-input="picture_3"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="picture_4Edit" class="form-label">Photo Service/Offre 3</label>
                <input id="picture_4Edit" name="picture_4" type="file" class="file" data-show-preview="false"
                    data-msg-placeholder="Sélectionner l'image...">

                <div class="alert alert-danger" error-input="picture_4"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="category_idEdit">Catégorie Partenaire <span class="text-danger">*</span></label>
                <select class="form-select" id="category_idEdit" name="category_id">
                    <option selected value="">Sélectionnez la catégorie de partenaire</option>
                    @foreach ($partner_categories as $category)
                        <option value="{{ $category->id }}" @selected($partner->category_id == $category->id)>{{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <div class="alert alert-danger" error-input="category_id"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="min_amountEdit" class="form-label">Valeur Minimale Coupon <span
                        class="text-danger">*</span></label>

                <input type="number" class="form-control" name="min_amount"
                    value="{{ old('min_amount', $partner->min_amount) }}" id="min_amountEdit"
                    aria-describedby="min_amountHelp" placeholder="Entrez ici le prix" min="0" step="1" />

                <small id="min_amountHelp" class="form-text text-muted">Cette valeur représente le prix minimal d'un chèque
                    cadeau pour ce partenaire.</small>

                <div class="alert alert-danger" error-input="min_amount"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="phone_numberEdit" class="form-label">Tel <span class="text-danger">*</span></label>
                <input type="text" id="phone_numberEdit" class="form-control" name="phone_number"
                    value="{{ old('phone_number', $partner->phone_number) }}"
                    placeholder="Entrez son numéro de téléphone">
                <div class="alert alert-danger" error-input="phone_number"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="emailEdit" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="text" id="emailEdit" class="form-control" name="email"
                    value="{{ old('email', $partner->email) }}" placeholder="Entrez son adresse mail">
                <div class="alert alert-danger" error-input="email"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="adressEdit" class="form-label">Adresse physique</label>
                <input type="text" id="adressEdit" class="form-control" name="adress"
                    value="{{ old('adress', $partner->adress) }}" placeholder="Entrez son adresse">
                <div class="alert alert-danger" error-input="adress"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="short_descriptionEdit" class="form-label">Phrase de présentation</label>
                <input type="text" id="short_descriptionEdit" class="form-control" name="short_description"
                    value="{{ old('short_description', $partner->short_description) }}"
                    placeholder="Entrez une courte phrase caractérisant l'identité de l'entreprise">
                <div class="alert alert-danger" error-input="short_description"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="descriptionEdit" class="form-label">Texte descriptif <span
                        class="text-danger">*</span></label>
                <textarea class="form-control" name="description" id="descriptionEdit" rows="4">{{ $partner->description }}</textarea>
                <div class="alert alert-danger" error-input="description"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="offersEdit" class="form-label">Offres/Services <span class="text-danger">*</span></label>
                <textarea class="form-control" name="offers" id="offersEdit" rows="4">{{ $partner->offers }}</textarea>
                <div class="alert alert-danger" error-input="offers"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="tagsEdit" class="form-label">Tags <span class="text-muted">(utiliser des virgules `,` pour
                        séparer les tags)</span></label>
                <input type="text" id="tagsEdit" class="form-control" name="tags"
                    value="{{ old('tags', $partner->tags) }}" placeholder="Ex: beauté, sport, santé ...">
                <div class="alert alert-danger" error-input="tags"></div>
            </div>

            <div class="alert alert-danger" error-input="general"></div>

            <button type="submit" class="w-100 btn btn-primary btn-rounded mt-3">Créer</button>
        </form>

    </div>
@endsection


@section('additionnal_js')
    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/backoffice/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- Bootstrap File Input JS -->
    <script src="{{ asset('assets/backoffice/js/plugin/bootstrap-fileinput/buffer.min.js') }}"></script>
    <script src="{{ asset('assets/backoffice/js/plugin/bootstrap-fileinput/filetype.min.js') }}"></script>
    <script src="{{ asset('assets/backoffice/js/plugin/bootstrap-fileinput/fileinput.min.js') }}"></script>

    <!-- JQuery Validate Plugin -->
    <script src="{{ asset('assets/backoffice/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>

    <script>
        $(function() {

            // Reset du formulaire
            resetFormAdd()


            // Validation client du formulaire d'ajout
            $("#updateProfile").validate({
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
            $('#updateProfile div.alert').addClass('d-none')
            $('#updateProfile').trigger('reset')
        }
    </script>
@endsection
