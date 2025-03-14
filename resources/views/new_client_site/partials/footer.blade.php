<!-- Footer Area -->
<footer class="footer-area footer-bg">
    <div class="footer-top">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-5">
                    <div class="newsletter-title">
                        <i class="flaticon-email"></i>
                        <h2>Ne manquez pas nos actualités ! </h2>
                    </div>
                </div>

                <div class="col-lg-6 col-md-7">
                    <div class="newsletter-area">
                        <form class="newsletter-form" data-toggle="validator" method="POST">
                            <input type="email" class="form-control" placeholder="Votre Email*" name="EMAIL"
                                required autocomplete="off">
                            <button class="default-btn border-radius" type="submit">
                                S’abonner
                            </button>
                            <div id="validator-newsletter" class="form-result"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-middle pt-100 pb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <a href="{{ route('client.home') }}" class="logo">
                            <img src="{{ asset('assets/LOGO CADEAURAPIDE.png') }}" alt="Logo">
                        </a>
                        <p>
                            Cadeau Rapide est votre solution de chèques cadeaux personnalisés, vous permettant d'offrir
                            des expériences uniques et mémorables à vos proches. <br><br> Facile à utiliser et rapide,
                            notre
                            plateforme vous aide à créer des chèques cadeaux sur mesure pour toutes les occasions.
                            Rejoignez notre communauté et faites plaisir à ceux que vous aimez !
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget pl-5">
                        <h3>CONTACT</h3>
                        <ul class="footer-contact-list">
                            <li>
                                <span class="icon icon-location"></span>
                                <address>824 Bel Meadow Drive, California, USA</address>
                            </li>
                            <li>
                                <span>Monday - Friday :</span> 9 am to 6 pm
                            </li>
                            <li>
                                <span>Saturday - Sunday :</span> 9 am to 2 pm
                            </li>
                            <li>
                                <span>Phone :</span> <a href="tel:2151234567"> 215 - 123 - 4567</a> <br>
                                <a href="tel:2151234567"> 215 - 123 - 4567</a>
                            </li>
                            <li>
                                <span>Email :</span> <a href="mailto:{{ env('CONTACT_MAIL_ADDRESS') }}">
                                    {{ env('CONTACT_MAIL_ADDRESS') }}</a>
                            </li>
                        </ul>

                        <ul class="social-link">
                            <li>
                                <a href="https://www.facebook.com/login/" target="_blank"><i
                                        class='bx bxl-facebook'></i></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/i/flow/login" target="_blank"><i
                                        class='bx bxl-twitter'></i></a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/accounts/login/" target="_blank"><i
                                        class='bx bxl-instagram'></i></a>
                            </li>
                            <li>
                                <a href="https://www.pinterest.com/" target="_blank"><i
                                        class='bx bxl-pinterest-alt'></i></a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/" target="_blank"><i class='bx bxl-youtube'></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget pl-5">
                        <h3 class="text-uppercase">Support</h3>

                        <ul class="footer-contact-list">
                            <li><a href="javascript:void(0);">FAQ</a></li>
                            <li><a href="{{ route('client.policy') }}">Politique de confidentialité</a></li>
                            <li><a href="{{ route('client.general_terms') }}">Conditions Générales</a></li>
                            <li><a href="{{ route('client.contact') }}">Assistance Client</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget pl-5">
                        <h3 class="text-uppercase">Partenaires</h3>

                        <ul class="footer-contact-list">
                            <li><a href="{{ route('client.contact') }}">Devenir Partenaire</a></li>
                            <li><a href="{{ route('client.partner.index') }}">Tous les partenaires </a></li>
                            <li><a href="javascript:void(0);">Avantages Partenaire</a></li>
                            <li><a href="{{ route('partner.auth.login_page') }}">Connexion Partenaire</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->

<!-- Copy Right -->
<div class="copy-right-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8">
                <div class="copy-right-text">
                    <p>©️ 2024 - Tous droits réservés - Réalisé par Special Touch
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="copy-right-list">
                    <ul>
                        <li><a href="{{ route('client.home') }}">Accueil</a></li>
                        <li><a href="{{ route('client.about') }}">A propos</a></li>
                        <li><a href="{{ route('client.contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
