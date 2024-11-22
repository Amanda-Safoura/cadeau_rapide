@extends('new_client_site.layouts.main')

@section('title', 'Politique de Confidentialité')

@section('content')

    <!-- Inner Banner -->
    <div class="inner-banner inner-bg1">
        <div class="container">
            <div class="inner-title text-center">
                <h3>Politique de Confidentialité</h3>
                <ul>
                    <li>
                        <a href="{{ route('client.home') }}">Accueil</a>
                    </li>
                    <li>
                        <i class='bx bx-chevron-right'></i>
                    </li>
                    <li>Politique de Confidentialité</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Privacy & Policy Area -->
    <div class="privacy-policy-area ptb-100">
        <div class="container">
            <div class="single-content px-3 py-3 mx-auto">
                <p class="fs-4 fw-semibold mb-2 text-dark">Dernière mise à jour : 22 Novembre 2024</p>

                <p class="fs-5" style="margin-bottom: 20px">
                    Chez Cadeau Rapide, nous attachons une importance particulière à la confidentialité et à la protection
                    de
                    vos données personnelles. La présente Politique de confidentialité explique quelles données nous
                    collectons, pourquoi nous les collectons, comment nous les utilisons, et comment nous assurons leur
                    protection.
                </p>

                <h2 class="fs-4 fw-semibold mb-4 text-dark">1. Données Collectées</h2>
                <p class="fs-6 mb-4">
                    Nous collectons différents types d'informations dans le cadre de l'utilisation de notre plateforme,
                    notamment :
                </p>
                <ul class="list-unstyled ms-3" style="margin-bottom: 12px">
                    <li><strong>Données d'identification</strong> : nom, prénom, adresse e-mail, numéro de téléphone, etc.
                    </li>
                    <li><strong>Données de connexion</strong> : adresse IP, informations de connexion, type de navigateur,
                        système d’exploitation.</li>
                    <li><strong>Données d'utilisation</strong> : informations sur votre utilisation de nos services, y
                        compris les pages consultées, les actions effectuées, les heures et dates de visite.</li>
                    <li><strong>Données de géolocalisation</strong> : lorsque vous utilisez certaines fonctionnalités de
                        notre plateforme nécessitant la localisation géographique.</li>
                </ul>

                <h2 class="fs-4 fw-semibold mb-4 text-dark">2. Utilisation des Données</h2>
                <p class="fs-6 mb-4">
                    Vos données personnelles sont utilisées aux fins suivantes :
                </p>
                <ul class="list-unstyled ms-3" style="margin-bottom: 12px">
                    <li>Fournir, personnaliser et améliorer nos services.</li>
                    <li>Vous notifier sur les mises à jour, modifications et offres spéciales.</li>
                    <li>Gérer votre compte utilisateur et vous permettre un accès sécurisé à notre plateforme.</li>
                    <li>Assurer la sécurité de notre plateforme, détecter et prévenir les fraudes.</li>
                    <li>Réaliser des analyses et des études de marché afin d’améliorer nos services.</li>
                </ul>

                <h2 class="fs-4 fw-semibold mb-4 text-dark">3. Partage des Données</h2>
                <p class="fs-6 mb-4">
                    Vos données personnelles peuvent être partagées avec des tiers dans les cas suivants :
                </p>
                <ul class="list-unstyled ms-3" style="margin-bottom: 12px">
                    <li><strong>Fournisseurs de services</strong> : avec des prestataires et partenaires nécessaires au bon
                        fonctionnement de la plateforme.</li>
                    <li><strong>Obligations légales</strong> : si la loi l'exige, ou si nous sommes tenus de le faire dans
                        le cadre de procédures judiciaires.</li>
                    <li><strong>Avec votre consentement</strong> : dans tous les autres cas, nous obtiendrons votre
                        consentement avant de partager vos informations.</li>
                </ul>

                <h2 class="fs-4 fw-semibold mb-4 text-dark">4. Conservation des Données</h2>
                <p class="fs-6" style="margin-bottom: 12px">
                    Vos données personnelles sont conservées uniquement pendant la durée nécessaire aux fins pour lesquelles
                    elles ont été collectées, ou dans le respect des obligations légales et réglementaires en vigueur.
                </p>

                <h2 class="fs-4 fw-semibold mb-4 text-dark">5. Sécurité des Données</h2>
                <p class="fs-6" style="margin-bottom: 12px">
                    Nous mettons en place des mesures de sécurité techniques et organisationnelles pour protéger vos données
                    contre tout accès, modification, divulgation ou destruction non autorisés.
                </p>

                <h2 class="fs-4 fw-semibold mb-4 text-dark">6. Droits des Utilisateurs</h2>
                <p class="fs-6 mb-4">
                    Conformément aux lois en vigueur, vous disposez des droits suivants :
                </p>
                <ul class="list-unstyled ms-3" style="margin-bottom: 12px">
                    <li><strong>Droit d'accès</strong> : vous pouvez demander une copie des données personnelles que nous
                        détenons à votre sujet.</li>
                    <li><strong>Droit de rectification</strong> : vous pouvez demander la correction de vos données si elles
                        sont inexactes ou incomplètes.</li>
                    <li><strong>Droit d’opposition</strong> : vous pouvez vous opposer au traitement de vos données pour des
                        motifs légitimes.</li>
                    <li><strong>Droit à l’effacement</strong> : dans certains cas, vous pouvez demander la suppression de
                        vos données.</li>
                    <li><strong>Droit à la portabilité</strong> : vous pouvez demander à recevoir vos données dans un format
                        structuré et lisible.</li>
                </ul>
                <p class="fs-6" style="margin-bottom: 12px">
                    Pour exercer ces droits, veuillez nous contacter par e-mail à <a
                        href="mailto:{{ env('CONTACT_MAIL_ADDRESS') }}"
                        class="text-primary text-decoration-underline">{{ env('CONTACT_MAIL_ADDRESS') }}</a>.
                </p>

                <h2 class="fs-4 fw-semibold mb-4 text-dark">7. Modifications de la Politique de Confidentialité</h2>
                <p class="fs-6" style="margin-bottom: 12px">
                    Nous nous réservons le droit de modifier cette Politique de confidentialité. En cas de modification,
                    nous vous informerons par e-mail ou via une notification sur notre plateforme. Nous vous encourageons à
                    consulter régulièrement notre Politique de confidentialité pour rester informé des mises à jour.
                </p>

                <h2 class="fs-4 fw-semibold mb-4 text-dark">8. Contact</h2>
                <p class="fs-6">
                    Pour toute question ou préoccupation concernant notre Politique de confidentialité ou le traitement de
                    vos données, vous pouvez nous contacter à l’adresse suivante : <a
                        href="mailto:{{ env('CONTACT_MAIL_ADDRESS') }}"
                        class="text-primary text-decoration-underline">{{ env('CONTACT_MAIL_ADDRESS') }}</a>.
                </p>
            </div>
        </div>
    </div>
    <!-- Privacy & Policy Area End -->

@endsection
