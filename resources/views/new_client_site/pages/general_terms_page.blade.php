@extends('new_client_site.layouts.main')

@section('title', 'Conditions Générales')

@section('content')

    <!-- Inner Banner -->
    <div class="inner-banner inner-bg1">
        <div class="container">
            <div class="inner-title text-center">
                <h3>Conditions Générales</h3>
                <ul>
                    <li>
                        <a href="{{ route('client.home') }}">Accueil</a>
                    </li>
                    <li>
                        <i class='bx bx-chevron-right'></i>
                    </li>
                    <li>Conditions Générales</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Privacy & Policy Area -->
    <div class="privacy-policy-area ptb-100">
        <div class="container">
            <div class="single-content px-3 py-3 mx-auto">
                <p class="fs-4 fw-semibold mb-2">Dernière mise à jour : 22 Novembre 2024</p>

                <!-- Introduction -->
                <p class="fs-5" style="margin-bottom: 20px">
                    Les présentes Conditions Générales d'Utilisation (CGU) régissent l'accès et l'utilisation de la
                    plateforme {{ env('APP_NAME') }}. En accédant à la plateforme et en utilisant les services proposés,
                    vous
                    acceptez sans réserve ces CGU.
                </p>

                <!-- Section 1 : Présentation de la Plateforme -->
                <h2 class="fs-4 fw-semibold mb-4">1. Présentation de la Plateforme</h2>
                <p class="fs-6" style="margin-bottom: 12px">
                    {{ env('APP_NAME') }} est une plateforme qui propose des vidéos exclusives de portraits, d'opinions et
                    d'entretiens. Elle permet aux utilisateurs de consulter et de s’abonner pour accéder aux contenus.
                </p>

                <!-- Section 2 : Accès et Inscription -->
                <h2 class="fs-4 fw-semibold mb-4">2. Accès et Inscription</h2>
                <p class="fs-6" style="margin-bottom: 12px">
                    L’accès aux contenus de {{ env('APP_NAME') }} peut nécessiter une inscription et la création d’un
                    compte. Vous
                    devez fournir des informations exactes et à jour et garder vos identifiants confidentiels. Toute
                    activité effectuée avec vos identifiants est de votre responsabilité.
                </p>

                <!-- Section 3 : Utilisation de la Plateforme -->
                <h2 class="fs-4 fw-semibold mb-4">3. Utilisation de la Plateforme</h2>
                <p class="fs-6 mb-4">
                    L’utilisateur s’engage à utiliser la plateforme dans le respect des lois et règlements en vigueur ainsi
                    que des présentes CGU. Il est interdit de :
                </p>
                <ul class="list-unstyled ms-3" style="margin-bottom: 12px">
                    <li class="mb-1">• Diffuser, reproduire ou transmettre les contenus de {{ env('APP_NAME') }} à des
                        fins
                        commerciales sans autorisation préalable.</li>
                    <li class="mb-1">• Tenter d'accéder de manière non autorisée aux systèmes ou aux informations des
                        autres utilisateurs.</li>
                    <li>• Nuire au bon fonctionnement de la plateforme par des activités frauduleuses.</li>
                </ul>

                <!-- Section 4 : Propriété Intellectuelle -->
                <h2 class="fs-4 fw-semibold mb-4">4. Propriété Intellectuelle</h2>
                <p class="fs-6" style="margin-bottom: 12px">
                    Les contenus proposés sur {{ env('APP_NAME') }} (textes, vidéos, images, logos, etc.) sont protégés par
                    les
                    droits de propriété intellectuelle et sont la propriété exclusive de {{ env('APP_NAME') }} ou de ses
                    partenaires.
                    Toute reproduction ou utilisation non autorisée des contenus est strictement interdite.
                </p>

                <!-- Section 5 : Responsabilité -->
                <h2 class="fs-4 fw-semibold mb-4">5. Responsabilité</h2>
                <p class="fs-6" style="margin-bottom: 12px">
                    {{ env('APP_NAME') }} met en œuvre tous les moyens nécessaires pour assurer l’accessibilité de la
                    plateforme,
                    mais ne peut garantir un fonctionnement continu, sécurisé ou sans erreur. {{ env('APP_NAME') }} ne peut
                    être tenu
                    responsable des interruptions, erreurs ou autres limitations techniques.
                </p>

                <!-- Section 6 : Modification des CGU -->
                <h2 class="fs-4 fw-semibold mb-4">6. Modification des CGU</h2>
                <p class="fs-6" style="margin-bottom: 12px">
                    {{ env('APP_NAME') }} se réserve le droit de modifier les présentes CGU. En cas de modification, nous
                    vous en
                    informerons par e-mail ou par notification sur la plateforme. Nous vous invitons à consulter
                    régulièrement les CGU pour rester informé des éventuels changements.
                </p>

                <!-- Section 7 : Résiliation -->
                <h2 class="fs-4 fw-semibold mb-4">7. Résiliation</h2>
                <p class="fs-6" style="margin-bottom: 12px">
                    {{ env('APP_NAME') }} se réserve le droit de suspendre ou de résilier l’accès d’un utilisateur à la
                    plateforme en
                    cas de non-respect des présentes CGU ou de tout comportement jugé inapproprié.
                </p>

                <!-- Section 8 : Protection des Données Personnelles -->
                <h2 class="fs-4 fw-semibold mb-4">8. Protection des Données Personnelles</h2>
                <p class="fs-6" style="margin-bottom: 12px">
                    La protection de vos données est primordiale pour {{ env('APP_NAME') }}. Pour en savoir plus sur notre
                    collecte
                    et utilisation des données personnelles, veuillez consulter notre Politique de Confidentialité.
                </p>

                <!-- Section 9 : Droit Applicable et Juridiction Compétente -->
                <h2 class="fs-4 fw-semibold mb-4">9. Droit Applicable et Juridiction Compétente</h2>
                <p class="fs-6" style="margin-bottom: 12px">
                    Les présentes CGU sont régies par les lois en vigueur [du pays ou de la région de votre choix]. Tout
                    litige relatif à l’utilisation de la plateforme sera soumis à la juridiction des tribunaux compétents.
                </p>

                <!-- Section 10 : Contact -->
                <h2 class="fs-4 fw-semibold mb-4">10. Contact</h2>
                <p class="fs-6">
                    Pour toute question relative aux présentes CGU, vous pouvez nous contacter à l’adresse suivante : <a
                        href="mailto:{{ env('CONTACT_MAIL_ADDRESS') }}"
                        class="text-primary text-decoration-underline">{{ env('CONTACT_MAIL_ADDRESS') }}</a>.
                </p>
            </div>
        </div>
    </div>
    <!-- Privacy & Policy Area End -->

@endsection
