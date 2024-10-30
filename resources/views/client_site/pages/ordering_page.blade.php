@extends('client_site.layouts.main')

@section('title', 'Formulaire de Commande')

@section('additionnal_css')
    <style>
        /* Styles pour le modal personnalisé */
        .modal {
            display: none;
            /* Caché par défaut */
            position: fixed;
            /* Reste en place */
            z-index: 1000;
            /* Au-dessus des autres éléments */
            left: 0;
            top: 0;
            width: 100%;
            /* Pleine largeur */
            height: 100%;
            /* Pleine hauteur */
            overflow: hidden;
            /* Masque le scroll */
            background-color: rgba(0, 0, 0, 0.6);
            /* Fond noir transparent */
        }

        .modal-content {
            background-color: #fefefe;
            border-radius: 8px;
            /* Coins arrondis */
            padding: 20px;
            margin: auto;
            /* Centrer le modal */
            width: 90%;
            /* Largeur relative */
            max-width: 600px;
            /* Largeur maximum */
            max-height: 90vh;
            /* Hauteur maximale pour permettre le scroll */
            overflow-y: auto;
            /* Activer le scroll vertical */
            position: absolute;
            /* Positionnement absolu */
            left: 50%;
            /* Centrer horizontalement */
            top: 50%;
            /* Centrer verticalement */
            transform: translate(-50%, -50%);
            /* Centrer verticalement et horizontalement */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            /* Ombre autour du modal */
        }


        .modal-header {
            border-bottom: none;
            /* Enlever la bordure du header */
            margin-bottom: 15px;
            /* Espace entre le header et le contenu */
        }

        .modal-title {
            margin-bottom: 15px;
            /* Pas de marge par défaut */
            font-weight: bold;
            /* Titre en gras */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .stepwizard-step p {
            margin-top: 0px;
            color: #666;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .stepwizard-step button[disabled] {
            /*opacity: 1 !important;
                                    filter: alpha(opacity=100) !important;*/
        }

        .stepwizard .btn.disabled,
        .stepwizard .btn[disabled],
        .stepwizard fieldset[disabled] .btn {
            opacity: 1 !important;
            color: #bbb;
        }

        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-index: 0;
        }

        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }

        .form-control {
            background-color: #f7f7f7
        }
    </style>
@endsection

@section('content')

    <section class="banner banner3 bg-full overlay"
        style="background-image: url({{ asset('assets/backoffice/img/photos/unsplash-1.jpg') }});">
        <div class="holder">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>Formulaire de Commande</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="container pad-top-lg pad-bottom-lg">

            <div class="stepwizard">
                <div class="stepwizard-row setup-panel" style="display: flex; justify-content:center">
                    <div class="stepwizard-step col-xs-1">
                        <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                        <p><small>Chèque Cadeau</small></p>
                    </div>
                    <div class="stepwizard-step col-xs-1">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                        <p><small>Client</small></p>
                    </div>
                    <div class="stepwizard-step col-xs-1">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                        <p><small>Bénéficiaire</small></p>
                    </div>
                    <div class="stepwizard-step col-xs-1">
                        <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                        <p><small>Personnalisation</small></p>
                    </div>
                    <div class="stepwizard-step col-xs-1">
                        <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
                        <p><small>Livraison</small></p>
                    </div>
                    <div class="stepwizard-step col-xs-1">
                        <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled">6</a>
                        <p><small>Récapitulatif</small></p>
                    </div>
                    <div class="stepwizard-step col-xs-1">
                        <a href="#step-7" type="button" class="btn btn-default btn-circle" disabled="disabled">7</a>
                        <p><small>Paiement</small></p>
                    </div>
                </div>
            </div>

            <form id="giftCardForm" action="{{ route('client.order.store') }}" method="POST">
                @csrf

                <input type="hidden" name="partner_id" value="{{ $partner->id }}">
                <!-- Étape 1 : Informations du Chèque Cadeau -->
                <div class="step-content active" id="step-1">
                    <h2 class="text-center">Étape 1 : Informations du Chèque Cadeau</h2>
                    <div class="form-group">
                        <label>Montant du Chèque Cadeau</label>
                        <input type="number" class="form-control" name="amount" value="{{ old('amount') }}"
                            placeholder="Entrez le montant" required>
                        @error('amount')
                            <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Message Personnel (facultatif)</label>
                        <textarea class="form-control" name="personal_message" value="{{ old('personal_message') }}"
                            placeholder="Votre message"></textarea>
                        @error('personal_message')
                            <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <button type="button" class="btn btn-primary nextBtn pull-right">Suivant</button>
                </div>

                <!-- Étape 2 : Détails du Client -->
                <div class="step-content" id="step-2">
                    <h2 class="text-center">Étape 2 : Détails du Client</h2>
                    <div class="form-group">
                        <label>Nom du Client</label>
                        <input type="text" name="client_name" value="{{ old('client_name', auth()->user()->name) }}"
                            class="form-control" required>
                        @error('client_name')
                            <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email du Client</label>
                        <input type="email" name="client_email" value="{{ old('client_email', auth()->user()->email) }}"
                            class="form-control" required>
                        @error('client_email')
                            <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Numéro de Téléphone</label>
                        <input type="text" name="client_phone" value="{{ old('client_phone') }}" class="form-control"
                            required>
                        @error('client_phone')
                            <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <button type="button" class="btn btn-primary nextBtn pull-right">Suivant</button>
                </div>

                <!-- Étape 3 : Définir le Bénéficiaire -->
                <div class="step-content" id="step-3">
                    <h2 class="text-center">Étape 3 : Définir le Bénéficiaire</h2>
                    <div class="form-group">
                        <label>Êtes-vous le Bénéficiaire du Chèque Cadeau ?</label><br>
                        <label class="radio-inline">
                            <input type="radio" name="is_client_beneficiary" @checked(old('is_client_beneficiary') === '1' || !old('is_client_beneficiary'))
                                onclick="toggleBeneficiary(false)" value="1"> Oui
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="is_client_beneficiary" @checked(old('is_client_beneficiary') === '0')
                                onclick="toggleBeneficiary(true)" value="0"> Non
                        </label>

                        @error('is_client_beneficiary')
                            <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div id="beneficiaryFields" style="display: none;">
                        <div class="form-group">
                            <label>Nom du Bénéficiaire</label>
                            <input type="text" name="beneficiary_name" value="{{ old('beneficiary_name') }}"
                                class="form-control">
                            @error('beneficiary_name')
                                <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email du Bénéficiaire (facultatif)</label>
                            <input type="email" name="beneficiary_email" value="{{ old('beneficiary_email') }}"
                                class="form-control">
                            @error('beneficiary_email')
                                <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Numéro de Téléphone du Bénéficiaire</label>
                            <input type="text" name="beneficiary_phone" value="{{ old('beneficiary_phone') }}"
                                class="form-control">
                            @error('beneficiary_phone')
                                <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary nextBtn pull-right">Suivant</button>
                </div>

                <!-- Étape 4 : Personnalisation -->
                <div class="step-content" id="step-4">
                    <h2 class="text-center">Étape 4 : Personnalisation du Chèque Cadeau</h2>
                    <div class="form-group">
                        <label>Souhaitez-vous une personnalisation ?</label><br>
                        <label class="radio-inline">
                            <input type="radio" name="is_customized" @checked(old('is_customized') === '1') value="1"> Oui
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="is_customized" @checked(old('is_customized') === '0' || !old('is_customized')) value="0"> Non
                        </label>

                        @error('is_customized')
                            <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                        <input type="hidden" name="customization_fee" value="{{ env('CUSTOMIZATION_FEE') }}">
                    </div>

                    <button type="button" class="btn btn-primary nextBtn pull-right">Suivant</button>
                </div>

                <!-- Étape 5 : Choix de Livraison -->
                <div class="step-content" id="step-5">
                    <h2 class="text-center">Étape 5 : Choix de Livraison</h2>
                    <div class="form-group">
                        <label>Souhaitez-vous que nous livrions le chèque cadeau au bénéficiaire ?</label><br>
                        <label class="radio-inline">
                            <input type="radio" name="requires_delivery" @checked(old('requires_delivery') === '1') value="1"
                                onclick="toggleDelivery(true)">
                            Oui
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="requires_delivery" @checked(old('requires_delivery') === '0' || !old('requires_delivery')) value="0"
                                onclick="toggleDelivery(false)"> Non
                        </label>

                        @error('requires_delivery')
                            <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div id="deliveryOptions" style="display: none;">
                        <div class="form-group">
                            <label>Adresse de Livraison</label>
                            <input type="text" name="delivery_address" value="{{ old('delivery_address') }}"
                                class="form-control">
                            @error('delivery_address')
                                <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Date de Livraison</label>
                            <input type="date" name="delivery_date" value="{{ old('delivery_date') }}"
                                class="form-control">
                            @error('delivery_date')
                                <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Option de livraison</label>
                            <select class="form-control" name="shipping_id" id="shipping_id" required>
                                <option value="">Sélectionnez une option de livraison</option>
                                @foreach ($shippings as $shipping)
                                    <option value="{{ $shipping->id }}" shipping-price="{{ $shipping->price }}"
                                        @selected(old('shipping_id') == $shipping->id)>
                                        {{ $shipping->zone }}</option>
                                @endforeach
                            </select>

                            @error('shipping_id')
                                <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                    </div>

                    <button type="button" class="btn btn-primary nextBtn pull-right">Suivant</button>
                </div>

                <div class="step-content" id="step-6"></div>

                <!-- Étape 7 : Paiement -->
                <div class="step-content" id="step-7">
                    <h2 class="text-center">Étape 7 : Paiement</h2>
                    <div>
                        Montant à Payer:<strong id="total_amount"></strong>

                        @error('total_amount')
                            <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <!-- Choix du Mode de Paiement -->
                    <div class="form-group">
                        <label>Mode de Paiement</label><br>
                        <label class="radio-inline">
                            <input type="radio" name="payment_method" @checked(old('payment_method') === 'mobile' || !old('payment_method')) value="mobile"
                                onclick="togglePaymentMode(this.value)"> Mobile
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="payment_method" @checked(old('payment_method') === 'card')
                                id="payment_method_card" value="card" onclick="togglePaymentMode(this.value)">
                            Carte Bancaire
                        </label>

                        @error('payment_method')
                            <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div id="networkFields">
                        <div class="form-group">
                            <label>Pays</label>
                            <select class="form-control" id="countrySelect" required>
                                <option value="">Sélectionnez un Pays</option>
                                <option value="BENIN">Bénin</option>
                                <option value="SENEGAL">Sénégal</option>
                                <option value="CI">Côte d'Ivoire</option>
                                <option value="TOGO">Togo</option>
                                <!-- Ajoutez d'autres pays selon vos besoins -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Réseau du Numéro Mobile</label>
                            <select class="form-control" name="payment_network" id="networkSelect" required>
                                <option value="">Sélectionnez un Réseau</option>
                                <!-- Les options de réseau seront ajoutées ici par JavaScript -->
                            </select>

                            @error('payment_network')
                                <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Numéro de Téléphone</label>
                            <input type="text" name="payment_phone" value="{{ old('payment_phone') }}"
                                class="form-control" required>
                            @error('payment_phone')
                                <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group" id="otpField" style="display: none;">
                            <label>Code OTP (si applicable)</label>
                            <input type="text" name="payment_otp" value="{{ old('payment_otp') }}"
                                class="form-control">
                            @error('payment_otp')
                                <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Informations de Carte Bancaire (pour le paiement par carte) -->
                    <div id="cardPaymentFields" style="display: none;">

                        <select class="form-control" name="cardType" id="cardType" required>
                            <option value="">Sélectionnez le type de votre carte</option>
                            <option value="VISA" @selected('VISA' === old('cardType'))>VISA</option>
                            <option value="MASTERCARD" @selected('MASTERCARD' === old('cardType'))>MASTERCARD</option>
                        </select>

                        @error('cardType')
                            <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                        <div class="form-group">
                            <label for="firstNameCard">Prénom</label>
                            <input type="text" name="firstNameCard" value="{{ old('firstNameCard') }}"
                                id="firstNameCard" class="form-control" required>
                            @error('firstNameCard')
                                <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="lastNameCard">Nom</label>
                            <input type="text" name="lastNameCard" value="{{ old('lastNameCard') }}"
                                id="lastNameCard" class="form-control" required>
                            @error('lastNameCard')
                                <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="emailCard">Email</label>
                            <input type="email" name="emailCard" value="{{ old('emailCard') }}" id="emailCard"
                                class="form-control" required>
                            @error('emailCard')
                                <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="countryCard">Pays</label>
                            <input type="text" name="countryCard" value="{{ old('countryCard') }}" id="countryCard"
                                class="form-control" required>
                            @error('countryCard')
                                <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="addressCard">Adresse</label>
                            <input type="text" name="addressCard" value="{{ old('addressCard') }}" id="addressCard"
                                class="form-control" required>
                            @error('addressCard')
                                <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="districtCard">District</label>
                            <input type="text" name="districtCard" value="{{ old('districtCard') }}"
                                id="districtCard" class="form-control" required>
                            @error('districtCard')
                                <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="currency">Devise</label>
                            <select name="currency" id="currency" class="form-control" required>
                                <option value="">Sélectionner une devise</option>
                                <option value="XOF" @selected('XOF' === old('currency'))>XOF</option>
                                <option value="USD" @selected('USD' === old('currency'))>USD</option>
                                <option value="EUR" @selected('EUR' === old('currency'))>EUR</option>
                            </select>
                            @error('currency')
                                <div class="h5 bg-danger" role="alert" style="padding: 10px;color: #df2828d6;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Payer</button>
                </div>

            </form>
        </div>

        <!-- Modal pour afficher la réponse du serveur -->
        <div id="responseModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeResponseModal()">&times;</span>
                <h4 class="modal-title">
                    {{ session('message') }}
                </h4>
            </div>
        </div>
    </div>
@endsection

@section('additionnal_js')

    <!-- JQuery Validate Plugin -->
    <script src="{{ asset('assets/backoffice/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>

    <script>
        const networksByCountry = {
            BENIN: [{
                    value: 'MTN',
                    label: 'MTN'
                },
                {
                    value: 'MOOV',
                    label: 'MOOV'
                },
            ],
            SENEGAL: [{
                    value: 'ORANGE SN',
                    label: 'ORANGE SN'
                },
                {
                    value: 'FREE SN',
                    label: 'FREE SN'
                },
            ],
            CI: [{
                    value: 'ORANGE CI',
                    label: 'ORANGE CI'
                },
                {
                    value: 'MOOV CI',
                    label: 'MOOV CI'
                },
            ],
            TOGO: [{
                    value: 'TOGOCOM TG',
                    label: 'TOGOCOM TG'
                },
                {
                    value: 'MOOV TG',
                    label: 'MOOV TG'
                },
            ],
            // Ajoutez d'autres pays et leurs opérateurs respectifs ici
        };


        // Fonction pour générer le récapitulatif des informations saisies
        function generateSummary() {
            let amount = $('input[name="amount"]').val()
            let personalMessage = $('textarea[name="personal_message"]').val()
            let clientName = $('input[name="client_name"]').val()
            let clientEmail = $('input[name="client_email"]').val()
            let clientPhone = $('input[name="client_phone"]').val()
            let beneficiaryName = $('input[name="beneficiary_name"]').val() || "Vous-même"
            let beneficiaryEmail = $('input[name="beneficiary_email"]').val() || "Non fourni"
            let beneficiaryPhone = $('input[name="beneficiary_phone"]').val() || "Non fourni"
            let isCustomized = $('input[name="is_customized"]:checked').val() == "1" ? "Oui" : "Non"
            let requiresDelivery = $('input[name="requires_delivery"]:checked').val() == "1" ? "Oui" : "Non"
            let deliveryAddress = $('input[name="delivery_address"]').val() || "Non applicable"
            let shipping = $('#shipping_id option:selected').attr('shipping-price') || "Non applicable"
            let deliveryDate = $('input[name="delivery_date"]').val() || "Non applicable"

            // Insertion des valeurs dans le récapitulatif
            $('#step-6').html(`
                <h2 class="text-center">Étape 6 : Récapitulatif de Commande</h2>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Montant du Chèque Cadeau : </strong>${amount}</li>
                    <li class="list-group-item"><strong>Message Personnel : </strong>${personalMessage || "Non fourni"}</li>
                    <li class="list-group-item"><strong>Nom du Client : </strong>${clientName}</li>
                    <li class="list-group-item"><strong>Email du Client : </strong>${clientEmail}</li>
                    <li class="list-group-item"><strong>Téléphone du Client : </strong>${clientPhone}</li>
                    <li class="list-group-item"><strong>Nom du Bénéficiaire : </strong>${beneficiaryName}</li>
                    <li class="list-group-item"><strong>Email du Bénéficiaire : </strong>${beneficiaryEmail}</li>
                    <li class="list-group-item"><strong>Téléphone du Bénéficiaire : </strong>${beneficiaryPhone}</li>
                    <li class="list-group-item"><strong>Personnalisation : </strong>${isCustomized}</li>
                    <li class="list-group-item"><strong>Livraison : </strong>${requiresDelivery}</li>
                    <li class="list-group-item"><strong>Adresse de Livraison : </strong>${deliveryAddress}</li>
                    <li class="list-group-item"><strong>Date de Livraison : </strong>${deliveryDate}</li>
                    <li class="list-group-item"><strong>Frais de Livraison : </strong>${shipping}</li>
                </ul>
                <button type="button" class="btn btn-success nextBtn pull-right">Passer au Paiement</button>
            `)
        }


        // Afficher le paiment par Mobile Money ou carte bancaire
        function togglePaymentMode(mode) {
            const networkFields = document.getElementById('networkFields');
            const cardPaymentFields = document.getElementById('cardPaymentFields');

            if (mode === 'mobile') {
                networkFields.style.display = 'block';
                cardPaymentFields.style.display = 'none';
            } else {
                networkFields.style.display = 'none';
                cardPaymentFields.style.display = 'block';
            }
        }

        // Ajoutez un événement pour changer les réseaux lorsque le pays change
        document.getElementById('countrySelect').addEventListener('change', updateNetworks);

        // Fonction pour mettre à jour les réseaux en fonction du pays sélectionné
        function updateNetworks() {
            const countrySelect = document.getElementById('countrySelect');
            const networkSelect = document.getElementById('networkSelect');
            const selectedCountry = countrySelect.value;

            // Effacer les réseaux précédents
            networkSelect.innerHTML = '<option value="">Sélectionnez un Réseau</option>';

            if (networksByCountry[selectedCountry]) {
                networksByCountry[selectedCountry].forEach(network => {
                    const option = document.createElement('option');
                    option.value = network.value;
                    option.textContent = network.label;
                    networkSelect.appendChild(option);
                });
            }

            // Réinitialiser le champ OTP
            document.getElementById('otpField').style.display = 'none';
        }


        // Ajouter l'événement pour changer l'affichage de l'OTP selon le réseau sélectionné
        document.querySelector('select[name="payment_network"]').addEventListener('change', function() {
            toggleOtpField(this.value);
        });

        function toggleOtpField(network) {
            const otpField = document.getElementById('otpField');
            if (network === 'ORANGE SN') {
                otpField.style.display = 'block';
            } else {
                otpField.style.display = 'none';
            }
        }


        $(document).ready(function() {
            // Ajouter une méthode de validation personnalisée pour la date après aujourd'hui
            jQuery.validator.addMethod("afterToday", function(value, element) {
                // Obtenir la date actuelle sans l'heure
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                // Convertir la date saisie par l'utilisateur en format Date
                const inputDate = new Date(value);
                return inputDate > today;
            }, "La date doit être postérieure à aujourd'hui.");


            // Initialisation de la validation avec jQuery Validate
            $('#giftCardForm').validate({
                errorClass: "text-danger", // Classe d'erreur pour les messages de validation
                highlight: function(element) {
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                rules: {
                    amount: {
                        required: true,
                        number: true,
                        min: {{ $partner->min_amount }}
                    },
                    client_name: {
                        required: true
                    },
                    client_email: {
                        required: true,
                        email: true
                    },
                    client_phone: {
                        required: true,
                        minlength: 8
                    },
                    beneficiary_name: {
                        required: function() {
                            return $('input[name="is_client_beneficiary"]:checked').val() == '0';
                        }
                    },
                    beneficiary_email: {
                        email: true
                    },
                    beneficiary_phone: {
                        required: function() {
                            return $('input[name="is_client_beneficiary"]:checked').val() == '0';
                        },
                        minlength: 8
                    },
                    delivery_address: {
                        required: function() {
                            return $('input[name="requires_delivery"]:checked').val() == '1';
                        }
                    },
                    delivery_date: {
                        required: function() {
                            return $('input[name="requires_delivery"]:checked').val() == '1';
                        },
                        date: true,
                        afterToday: true // Applique la validation personnalisée
                    },
                    payment_phone: {
                        required: true,
                        minlength: 8,
                        maxlength: 15 // Ajustez la longueur si nécessaire
                    },
                    payment_network: {
                        required: true,
                        string: true,
                        // Assurez-vous que les réseaux sont valides
                    },
                    payment_otp: {
                        required: function() {
                            return $('input[name="payment_network"]:checked').val() == 'ORANGE SN';
                        },
                        string: true // Ajoutez une validation pour le type de données
                    },
                    cardType: {
                        required: function() {
                            return $('#payment_method_card').is(
                                ':checked'); // Si le paiement par carte est sélectionné
                        }
                    },
                    firstNameCard: {
                        required: function() {
                            return $('#payment_method_card').is(
                                ':checked'); // Si le paiement par carte est sélectionné
                        },
                        maxlength: 255
                    },
                    lastNameCard: {
                        required: function() {
                            return $('#payment_method_card').is(
                                ':checked'); // Si le paiement par carte est sélectionné
                        },
                        maxlength: 255
                    },
                    emailCard: {
                        required: function() {
                            return $('#payment_method_card').is(
                                ':checked'); // Si le paiement par carte est sélectionné
                        },
                        email: function() {
                            return $('#payment_method_card').is(
                                ':checked'); // Si le paiement par carte est sélectionné
                        },
                        maxlength: 255
                    },
                    countryCard: {
                        required: function() {
                            return $('#payment_method_card').is(
                                ':checked'); // Si le paiement par carte est sélectionné
                        },
                        maxlength: 100
                    },
                    addressCard: {
                        required: function() {
                            return $('#payment_method_card').is(
                                ':checked'); // Si le paiement par carte est sélectionné
                        },
                        maxlength: 500
                    },
                    districtCard: {
                        required: function() {
                            return $('#payment_method_card').is(
                                ':checked'); // Si le paiement par carte est sélectionné
                        },
                        maxlength: 100
                    },
                    currency: {
                        required: function() {
                            return $('#payment_method_card').is(
                                ':checked'); // Si le paiement par carte est sélectionné
                        },
                        maxlength: 3
                    }
                },
                messages: {
                    amount: {
                        required: "Veuillez entrer le montant du chèque cadeau.",
                        number: "Le montant doit être un nombre.",
                        min: "Le montant doit être supérieur ou égal à 10 000."
                    },
                    client_name: "Veuillez entrer votre nom.",
                    client_email: {
                        required: "Veuillez entrer votre email.",
                        email: "Veuillez entrer un email valide."
                    },
                    client_phone: {
                        required: "Veuillez entrer votre numéro de téléphone.",
                        minlength: "Le numéro de téléphone doit contenir au moins 8 chiffres."
                    },
                    beneficiary_name: "Veuillez entrer le nom du bénéficiaire.",
                    beneficiary_email: "Veuillez entrer un email valide pour le bénéficiaire.",
                    beneficiary_phone: {
                        required: "Veuillez entrer le numéro de téléphone du bénéficiaire.",
                        minlength: "Le numéro de téléphone doit contenir au moins 8 chiffres."
                    },
                    delivery_address: "Veuillez entrer l'adresse de livraison.",
                    delivery_date: {
                        required: "Veuillez sélectionner une date de livraison.",
                        date: "Veuillez entrer une date valide.",
                        afterToday: "La date doit être postérieure à aujourd'hui." // Message personnalisé
                    },
                    // Messages pour le paiement
                    payment_phone: {
                        required: "Veuillez entrer votre numéro de téléphone.",
                        minlength: "Le numéro de téléphone doit contenir au moins 10 chiffres.",
                        maxlength: "Le numéro de téléphone ne peut pas dépasser 20 chiffres."
                    },
                    payment_network: "Veuillez sélectionner un réseau de paiement.",
                    payment_otp: {
                        required: "Veuillez entrer le code OTP pour ORANGE SN."
                    },
                    cardType: {
                        required: "Veuillez sélectionner le type de votre carte.",
                    },
                    firstNameCard: "Veuillez entrer votre prénom.",
                    lastNameCard: "Veuillez entrer votre nom.",
                    emailCard: {
                        required: "Veuillez entrer votre adresse email.",
                        email: "Veuillez entrer une adresse email valide."
                    },
                    countryCard: "Veuillez entrer votre pays.",
                    addressCard: "Veuillez entrer votre adresse.",
                    districtCard: "Veuillez entrer votre district.",
                    currency: "Veuillez sélectionner une devise."
                }
            });

            var navListItems = $('div.setup-panel div a'),
                allWells = $('.step-content'),
                allNextBtn = $('.nextBtn');

            allWells.hide();

            navListItems.click(function(e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-success').addClass('btn-default');
                    $item.addClass('btn-success');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allNextBtn.click(function() {
                var curStep = $(this).closest(".step-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next()
                    .children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;


                if (curStepBtn === 'step-5')
                    generateSummary()


                $(".form-group").removeClass("has-error");
                for (var i = 0; i < curInputs.length; i++) {
                    if (!curInputs[i].validity.valid) {
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }

                if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-success').trigger('click');

            // Affichage conditionnel des champs pour le bénéficiaire et la livraison
            window.toggleBeneficiary = function(show) {
                $('#beneficiaryFields').toggle(show)
            }

            window.toggleDelivery = function(show) {
                $('#deliveryOptions').toggle(show)
            }
        })

        // Fonction pour ouvrir le modal de réclamation
        function openResponseModal() {
            document.getElementById('responseModal').style.display = 'block';
            document.body.style.overflow = 'hidden'; // Empêche le scroll de la page en dehors du modal
        }

        @if (session('message'))
            openResponseModal()
        @endif

        // Fonction pour fermer le modal de réclamation
        function closeResponseModal() {
            document.getElementById('responseModal').style.display = 'none';
            document.body.style.overflow = 'auto'; // Rétablit le scroll de la page
        }

        // Fermer le modal en cliquant en dehors de celui-ci
        window.onclick = function(event) {
            if (event.target === document.getElementById('responseModal')) {
                closeResponseModal();
            }
        }
    </script>
@endsection
