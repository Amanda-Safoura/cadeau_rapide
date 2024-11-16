@extends('new_client_site.layouts.main')

@section('title', 'Formulaire de Commande')

@section('additionnal_css')
    <link rel="stylesheet" href="{{ asset('assets/new_client_side/plugins/bs-stepper/css/bs-stepper.css') }}">
    <style>
        .bs-stepper .step-trigger {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .bs-stepper .bs-stepper-circle {
            margin-bottom: 0.5rem;
            /* Espace entre le cercle et le label */
        }

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
    </style>
@endsection

@section('content')

    <!-- Inner Banner -->
    <div class="inner-banner inner-bg1">
        <div class="container">
            <div class="inner-banner-title text-center">
                <h3>Formulaire de commande</h3>
                <p>{{ $partner->name }}</p>
            </div>

            <div class="banner-list">
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <div class="contact-area">
        <div class="container">
            <div class="contact-max">
                <div class="row justify-content-center">
                    <div id="stepper" class="bs-stepper">
                        <div class="bs-stepper-header d-flex justify-content-between" role="tablist">
                            <div class="step" data-target="#step1">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Chèque Cadeau</span>
                                </button>
                            </div>
                            <div class="step" data-target="#step2">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Client</span>
                                </button>
                            </div>
                            <div class="step" data-target="#step3">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">Bénéficiaire</span>
                                </button>
                            </div>
                            <div class="step" data-target="#step4">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">4</span>
                                    <span class="bs-stepper-label">Personnalisation</span>
                                </button>
                            </div>
                            <div class="step" data-target="#step5">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">5</span>
                                    <span class="bs-stepper-label">Livraison</span>
                                </button>
                            </div>
                            <div class="step" data-target="#step6">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">6</span>
                                    <span class="bs-stepper-label">Récapitulatif</span>
                                </button>
                            </div>
                            <div class="step" data-target="#step7">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">7</span>
                                    <span class="bs-stepper-label">Paiement</span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <form id="giftCardForm" action="{{ route('client.order.store') }}" method="POST">
                                @csrf
                                @method('POST')

                                <input type="hidden" name="partner_id" value="{{ $partner->id }}">
                                <!-- Étape 1 : Informations du Chèque Cadeau -->
                                <div class="content" id="step1">
                                    <h2 class="text-center">Étape 1 : Informations du Chèque Cadeau</h2>
                                    <div class="mb-3 custom-form-input form-group">
                                        <label class="form-label" for="amount">Montant du Chèque Cadeau</label>
                                        <input id="amount" type="number" class="form-control" name="amount"
                                            value="{{ old('amount') }}" placeholder="Entrez le montant" required>
                                        <div class="alert alert-danger d-none" role="alert">
                                            @error('amount')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 custom-form-input form-group">
                                        <label class="form-label" for="personal_message">Message Personnel
                                            (facultatif)</label>
                                        <textarea id="personal_message" class="form-control" name="personal_message" value="{{ old('personal_message') }}"
                                            placeholder="Votre message"></textarea>
                                        <div class="alert alert-danger d-none" role="alert">
                                            @error('personal_message')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" onclick="nextStep()">Suivant</button>
                                </div>

                                <!-- Étape 2 : Détails du Client -->
                                <div class="content" id="step2">
                                    <h2 class="text-center">Étape 2 : Détails du Client</h2>
                                    <div class="mb-3 custom-form-input form-group">
                                        <label class="form-label" for="client_name">Nom du Client</label>
                                        <input id="client_name" type="text" name="client_name"
                                            value="{{ old('client_name', auth()->user()->name) }}" class="form-control"
                                            required>
                                        <div class="alert alert-danger d-none" role="alert">
                                            @error('client_name')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 custom-form-input form-group">
                                        <label class="form-label" for="client_email">Email du Client</label>
                                        <input id="client_email" type="email" name="client_email"
                                            value="{{ old('client_email', auth()->user()->email) }}" class="form-control"
                                            required>
                                        <div class="alert alert-danger d-none" role="alert">
                                            @error('client_email')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 custom-form-input form-group">
                                        <label class="form-label" for="client_phone">Numéro de Téléphone</label>
                                        <input id="client_phone" type="text" name="client_phone"
                                            value="{{ old('client_phone') }}" class="form-control" required>
                                        <div class="alert alert-danger d-none" role="alert">
                                            @error('client_phone')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-secondary me-3"
                                        onclick="previousStep()">Précédent</button>
                                    <button type="button" class="btn btn-primary" onclick="nextStep()">Suivant</button>
                                </div>

                                <!-- Étape 3 : Définir le Bénéficiaire -->
                                <div class="content" id="step3">
                                    <h2 class="text-center">Étape 3 : Définir le Bénéficiaire</h2>
                                    <div class="mb-3 custom-form-input form-group">
                                        <label class="form-label">Êtes-vous le Bénéficiaire du Chèque Cadeau ?</label><br>
                                        <div class="form-check form-check-inline">
                                            <input id="is_client_beneficiary_1" type="radio" class="form-check-input"
                                                name="is_client_beneficiary" @checked(old('is_client_beneficiary') === '1' || !old('is_client_beneficiary'))
                                                onclick="toggleBeneficiary(false)" value="1">
                                            <label for="is_client_beneficiary_1" class="form-check-label">Oui
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input id="is_client_beneficiary_0" type="radio" class="form-check-input"
                                                name="is_client_beneficiary" @checked(old('is_client_beneficiary') === '0')
                                                onclick="toggleBeneficiary(true)" value="0">
                                            <label for="is_client_beneficiary_0" class="form-check-label">Non
                                            </label>
                                        </div>

                                        <div class="alert alert-danger d-none" role="alert">
                                            @error('is_client_beneficiary')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="beneficiaryFields" style="display: none;">
                                        <div class="mb-3 custom-form-input form-group">
                                            <label class="form-label" for="beneficiary_name">Nom du Bénéficiaire</label>
                                            <input id="beneficiary_name" type="text" name="beneficiary_name"
                                                value="{{ old('beneficiary_name') }}" class="form-control">
                                            <div class="alert alert-danger d-none" role="alert">
                                                @error('beneficiary_name')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 custom-form-input form-group">
                                            <label class="form-label" for="beneficiary_email">Email du Bénéficiaire
                                                (facultatif)</label>
                                            <input id="beneficiary_email" type="email" name="beneficiary_email"
                                                value="{{ old('beneficiary_email') }}" class="form-control">
                                            <div class="alert alert-danger d-none" role="alert">
                                                @error('beneficiary_email')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 custom-form-input form-group">
                                            <label class="form-label" for="beneficiary_phone">Numéro de Téléphone du
                                                Bénéficiaire</label>
                                            <input id="beneficiary_phone" type="text" name="beneficiary_phone"
                                                value="{{ old('beneficiary_phone') }}" class="form-control">
                                            <div class="alert alert-danger d-none" role="alert">
                                                @error('beneficiary_phone')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-secondary me-3"
                                        onclick="previousStep()">Précédent</button>
                                    <button type="button" class="btn btn-primary" onclick="nextStep()">Suivant</button>
                                </div>

                                <!-- Étape 4 : Personnalisation -->
                                <div class="content" id="step4">
                                    <h2 class="text-center">Étape 4 : Personnalisation du Chèque Cadeau</h2>
                                    <div class="mb-3 custom-form-input form-group">
                                        <label class="form-label">Souhaitez-vous une personnalisation ?</label><br>
                                        <div class="form-check form-check-inline">
                                            <input id="is_customized_1" type="radio" class="form-check-input"
                                                name="is_customized" @checked(old('is_customized') === '1') value="1">
                                            <label for="is_customized_1" class="form-check-label">
                                                Oui
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input id="is_customized_0" type="radio" class="form-check-input"
                                                name="is_customized" @checked(old('is_customized') === '0' || !old('is_customized')) value="0">
                                            <label for="is_customized_0" class="form-check-label">
                                                Non
                                            </label>
                                        </div>

                                        <div class="alert alert-danger d-none" role="alert">
                                            @error('is_customized')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="customization_fee" value="{{ $customization_fee }}">
                                    </div>

                                    <button type="button" class="btn btn-secondary me-3"
                                        onclick="previousStep()">Précédent</button>
                                    <button type="button" class="btn btn-primary" onclick="nextStep()">Suivant</button>
                                </div>

                                <!-- Étape 5 : Détails de la Livraison -->
                                <div class="content" id="step5">
                                    <h2 class="text-center">Étape 5 : Détails de la Livraison</h2>

                                    <div class="mb-5 custom-form-input form-group">
                                        <div><label class="form-label">Option de livraison</label></div>
                                        <select class="form-control" name="shipping_id" id="shipping_id" required>
                                            <option value="">Sélectionnez une option de livraison</option>
                                            @foreach ($shippings as $shipping)
                                                <option value="{{ $shipping->id }}"
                                                    shipping-price="{{ $shipping->price }}" @selected(old('shipping_id') == $shipping->id)>
                                                    {{ $shipping->zone }}</option>
                                            @endforeach
                                        </select>

                                        <div class="alert alert-danger d-none" role="alert">
                                            @error('shipping_id')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 custom-form-input form-group">
                                        <label class="form-label" for="delivery_address">Adresse de Livraison</label>
                                        <textarea id="delivery_address" name="delivery_address" class="form-control">{{ old('delivery_address') }}</textarea>
                                        <div class="alert alert-danger d-none" role="alert">
                                            @error('delivery_address')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 custom-form-input form-group">
                                        <label class="form-label" for="delivery_date">Date de Livraison</label>
                                        <input type="date" name="delivery_date" id="delivery_date"
                                            value="{{ old('delivery_date') }}" class="form-control">
                                        <div class="alert alert-danger d-none" role="alert">
                                            @error('delivery_date')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="mb-3 custom-form-input form-group">
                                        <label class="form-label" for="delivery_contact">Numéro Personne à contacter
                                            (facultatif)</label>
                                        <input type="text" name="delivery_contact" id="delivery_contact"
                                            value="{{ old('delivery_contact') }}" class="form-control">
                                        <div class="alert alert-danger d-none" role="alert">
                                            @error('delivery_contact')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>


                                    <div>
                                        <button type="button" class="btn btn-secondary me-3"
                                            onclick="previousStep()">Précédent</button>
                                        <button type="button" class="btn btn-primary"
                                            onclick="nextStep()">Suivant</button>
                                    </div>
                                </div>

                                <div class="content" id="step6"></div>

                                <!-- Étape 7 : Paiement -->
                                <div class="content" id="step7">
                                    <h2 class="text-center">Étape 7 : Paiement</h2>
                                    <div>
                                        Montant à Payer: <strong id="total_amount"></strong>

                                        <div class="alert alert-danger d-none" role="alert">
                                            @error('total_amount')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Choix du Mode de Paiement -->
                                    <div class="mb-3 custom-form-input form-group">
                                        <label class="form-label">Mode de Paiement</label><br>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="payment_method_mobile"
                                                name="payment_method" @checked(old('payment_method') === 'mobile' || !old('payment_method')) value="mobile"
                                                onclick="togglePaymentMode(this.value)">
                                            <label for="payment_method_mobile" class="form-check-label">
                                                Mobile
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="payment_method"
                                                @checked(old('payment_method') === 'card') id="payment_method_card" value="card"
                                                onclick="togglePaymentMode(this.value)">
                                            <label for="payment_method_card" class="form-check-label">
                                                Carte Bancaire
                                            </label>
                                        </div>

                                        <div class="alert alert-danger d-none" role="alert">
                                            @error('payment_method')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="networkFields">
                                        <div class="mb-5 custom-form-input form-group">
                                            <div><label class="form-label">Pays</label></div>
                                            <select class="form-control" id="countrySelect" required>
                                                <option value="">Sélectionnez un Pays</option>
                                                <option value="BENIN">Bénin</option>
                                                <option value="SENEGAL">Sénégal</option>
                                                <option value="CI">Côte d'Ivoire</option>
                                                <option value="TOGO">Togo</option>
                                                <!-- Ajoutez d'autres pays selon vos besoins -->
                                            </select>
                                        </div>

                                        <div class="mb-5 custom-form-input form-group">
                                            <div><label class="form-label">Réseau du Numéro Mobile</label></div>
                                            <select class="form-control" name="payment_network" id="networkSelect"
                                                required>
                                                <option value="">Sélectionnez un Réseau</option>
                                                <!-- Les options de réseau seront ajoutées ici par JavaScript -->
                                            </select>

                                            <div class="alert alert-danger d-none" role="alert">
                                                @error('payment_network')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 custom-form-input form-group">
                                            <label class="form-label" for="payment_phone">Numéro de Téléphone</label>
                                            <input type="text" id="payment_phone" name="payment_phone"
                                                value="{{ old('payment_phone') }}" class="form-control" required>
                                            <div class="alert alert-danger d-none" role="alert">
                                                @error('payment_phone')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 custom-form-input form-group" id="otpField"
                                            style="display: none;">
                                            <label class="form-label" for="payment_otp">Code OTP (si applicable)</label>
                                            <input type="text" id="payment_otp" name="payment_otp"
                                                value="{{ old('payment_otp') }}" class="form-control">
                                            <div class="alert alert-danger d-none" role="alert">
                                                @error('payment_otp')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informations de Carte Bancaire (pour le paiement par carte) -->
                                    <div id="cardPaymentFields" style="display: none;">

                                        <select class="form-control" name="cardType" id="cardType" required>
                                            <option value="">Sélectionnez le type de votre carte</option>
                                            <option value="VISA" @selected('VISA' === old('cardType'))>VISA</option>
                                            <option value="MASTERCARD" @selected('MASTERCARD' === old('cardType'))>MASTERCARD</option>
                                        </select>

                                        <div class="alert alert-danger d-none" role="alert">
                                            @error('cardType')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="mb-3 custom-form-input form-group">
                                            <label class="form-label" for="firstNameCard">Prénom</label>
                                            <input type="text" name="firstNameCard"
                                                value="{{ old('firstNameCard') }}" id="firstNameCard"
                                                class="form-control" required>
                                            <div class="alert alert-danger d-none" role="alert">
                                                @error('firstNameCard')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 custom-form-input form-group">
                                            <label class="form-label" for="lastNameCard">Nom</label>
                                            <input type="text" name="lastNameCard" value="{{ old('lastNameCard') }}"
                                                id="lastNameCard" class="form-control" required>
                                            <div class="alert alert-danger d-none" role="alert">
                                                @error('lastNameCard')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 custom-form-input form-group">
                                            <label class="form-label" for="emailCard">Email</label>
                                            <input type="email" name="emailCard" value="{{ old('emailCard') }}"
                                                id="emailCard" class="form-control" required>
                                            <div class="alert alert-danger d-none" role="alert">
                                                @error('emailCard')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 custom-form-input form-group">
                                            <label class="form-label" for="countryCard">Pays</label>
                                            <input type="text" name="countryCard" value="{{ old('countryCard') }}"
                                                id="countryCard" class="form-control" required>
                                            <div class="alert alert-danger d-none" role="alert">
                                                @error('countryCard')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 custom-form-input form-group">
                                            <label class="form-label" for="addressCard">Adresse</label>
                                            <input type="text" name="addressCard" value="{{ old('addressCard') }}"
                                                id="addressCard" class="form-control" required>
                                            <div class="alert alert-danger d-none" role="alert">
                                                @error('addressCard')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 custom-form-input form-group">
                                            <label class="form-label" for="districtCard">District</label>
                                            <input type="text" name="districtCard" value="{{ old('districtCard') }}"
                                                id="districtCard" class="form-control" required>
                                            <div class="alert alert-danger d-none" role="alert">
                                                @error('districtCard')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-5 custom-form-input form-group">
                                            <div><label class="form-label" for="currency">Devise</label></div>
                                            <select name="currency" id="currency" class="form-control" required>
                                                <option value="">Sélectionner une devise</option>
                                                <option value="XOF" @selected('XOF' === old('currency'))>XOF</option>
                                                <option value="USD" @selected('USD' === old('currency'))>USD</option>
                                                <option value="EUR" @selected('EUR' === old('currency'))>EUR</option>
                                            </select>
                                            <div class="alert alert-danger d-none" role="alert">
                                                @error('currency')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary me-3"
                                        onclick="previousStep()">Précédent</button>
                                    <button type="submit" class="btn btn-success">Payer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal pour afficher la réponse du serveur -->
        <div id="responseModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeResponseModal()">&times;</span>
                <h4 class="modal-title text-center">
                    {!! session('message') !!}
                </h4>
            </div>
        </div>
    </div>

@endsection

@section('additionnal_js')

    <!-- JQuery Validate Plugin -->
    <script src="{{ asset('assets/backoffice/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/new_client_side/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>

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
            let shipping = $('#shipping_id option:selected').attr('shipping-price') || "Non défini"
            let deliveryAddress = $('input[name="delivery_address"]').val() || "Non défini"
            let deliveryDate = $('input[name="delivery_date"]').val() || "Non défini"
            let deliveryContact = $('input[name="delivery_contact"]').val() || "Non défini"

            // Insertion des valeurs dans le récapitulatif
            $('#step6').html(`
                <h2 class="text-center">Étape 6 : Récapitulatif de Commande</h2>
                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>Montant du Chèque Cadeau : </strong>${amount}</li>
                    <li class="list-group-item"><strong>Message Personnel : </strong>${personalMessage || "Non fourni"}</li>
                    <li class="list-group-item"><strong>Nom du Client : </strong>${clientName}</li>
                    <li class="list-group-item"><strong>Email du Client : </strong>${clientEmail}</li>
                    <li class="list-group-item"><strong>Téléphone du Client : </strong>${clientPhone}</li>
                    <li class="list-group-item"><strong>Nom du Bénéficiaire : </strong>${beneficiaryName}</li>
                    <li class="list-group-item"><strong>Email du Bénéficiaire : </strong>${beneficiaryEmail}</li>
                    <li class="list-group-item"><strong>Téléphone du Bénéficiaire : </strong>${beneficiaryPhone}</li>
                    <li class="list-group-item"><strong>Personnalisation : </strong>${isCustomized}</li>
                    <li class="list-group-item"><strong>Adresse de Livraison : </strong>${deliveryAddress}</li>
                    <li class="list-group-item"><strong>Date de Livraison : </strong>${deliveryDate}</li>
                    <li class="list-group-item"><strong>Numéro de la Peronne à contacter : </strong>${deliveryContact}</li>
                    <li class="list-group-item"><strong>Frais de Livraison : </strong>${shipping}</li>
                </ul>
                <button type="button" class="btn btn-secondary me-3" onclick="previousStep()">Précédent</button>
                <button type="button" class="btn btn-success" onclick="nextStep()">Passer au Paiement</button>
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
        $('#countrySelect').on('change', function() {
            const country = $(this).val()

            const networkSelect = $('#networkSelect');
            const optionList = $('#networkSelect').next().find('ul.list')

            // Effacer les réseaux précédents
            $(networkSelect).html('<option value="">Sélectionnez un Réseau</option>');
            $(optionList).html(`<li data-value="" class="option">Sélectionnez un Réseau</option></li>`)

            if (networksByCountry[country]) {
                networksByCountry[country].forEach(network => {
                    $(networkSelect).append(`<option val="${network.value}">${network.label}</option>`);

                    $(optionList).append(
                        `<li data-value="${network.value}" class="option">${network.label}</li>`);
                });
            }

            // Réinitialiser le champ OTP
            document.getElementById('otpField').style.display = 'none';
        });

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
                highlight: function(element) {
                    $(element).closest('.custom-form-input').find('div.alert').removeClass('d-none')
                },
                unhighlight: function(element) {
                    $(element).closest('.custom-form-input').find('div.alert').addClass('d-none')
                },
                errorPlacement: function(error, element) {
                    $(element).closest('.custom-form-input').find('div.alert').text(error.text())
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
                        required: true
                    },
                    delivery_date: {
                        required: true,
                        date: true,
                        afterToday: true // Applique la validation personnalisée
                    },
                    delivery_contact: {
                        required: false,
                        minlength: 8,
                        maxlength: 15
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
                        min: "Le montant doit être supérieur ou égal à {{ number_format($partner->min_amount, 0, '', ' ') }}."
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
                    delivery_contact: {
                        minlength: "Le numéro de téléphone doit contenir au moins 8 chiffres.",
                        maxlength: "Le numéro de téléphone ne peut pas dépasser 15 chiffres."
                    },
                    // Messages pour le paiement
                    payment_phone: {
                        required: "Veuillez entrer votre numéro de téléphone.",
                        minlength: "Le numéro de téléphone doit contenir au moins 8 chiffres.",
                        maxlength: "Le numéro de téléphone ne peut pas dépasser 15 chiffres."
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

            // Affichage conditionnel des champs pour le bénéficiaire et la livraison
            window.toggleBeneficiary = function(show) {
                $('#beneficiaryFields').toggle(show)
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


        let stepper = new Stepper(document.querySelector('#stepper'));

        // Fonction pour passer à l'étape suivante si valide
        function nextStep() {
            let currentStep = stepper._currentIndex + 1;

            if (currentStep === 5) generateSummary()
            if (currentStep === 6) {
                let totalAmount = parseInt($('#amount').val())
                totalAmount += parseInt($('#shipping_id option:selected').attr('shipping-price'))

                if ($('input[name="is_customized"]:checked').val() == "1") totalAmount += parseInt($(
                    'input[name="customization_fee"]').val())

                $('#total_amount').text(totalAmount + '')
            }

            if ($('#giftCardForm').valid()) { // Vérifie la validation de toutes les étapes
                stepper.next();
            }
        }

        // Fonction pour revenir à l'étape précédente
        function previousStep() {
            stepper.previous();
        }
    </script>
@endsection
