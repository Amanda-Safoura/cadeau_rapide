<footer id="footer" class="footer2">
    <!-- footer holder of the page -->
    <div class="footer-holder container">
        <div class="row">
            <div class="col-xs-12">
                <div class="col1">
                    <h3 class="text-uppercase">Contact</h3>
                    <ul class="list-unstyled contact-list">
                        <li>
                            <span class="icon icon-location"></span>
                            <address>824 Bel Meadow Drive, California, USA</address>
                        </li>
                        <li>
                            <span class="icon icon-phone"></span>
                            <span class="tel"><a href="tel:112345678520">(+11) 234 567 8520</a><a
                                    href="tel:112345678520">(+11) 234 567 8520</a></span>
                        </li>
                        <li>
                            <span class="icon icon-email"></span>
                            <span class="mail"><a href="mailto:Info@Coupmy.Com">Info@Coupmy.Com</a><a
                                    href="mailto:Mail@Coupmy.Com">Mail@Coupmy.Com</a></span>
                        </li>
                    </ul>
                </div>
                <div class="col2">
                    <h3 class="text-uppercase">Categories</h3>
                    <ul class="list-unstyled tags">
                        @foreach ($categories as $category)
                            <li><a
                                    href="{{ route('client.partner.category', ['name' => $category->id]) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col3">
                    <h3 class="text-uppercase">Support</h3>
                    <ul class="list-unstyled f-nav">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Politique de confidentialité</a></li>
                        <li><a href="#">Conditions Générales</a></li>
                        <li><a href="{{ route('client.contact') }}">Assistance Client</a></li>
                    </ul>
                </div>
                <div class="col4">
                    <h3 class="text-uppercase">Partenaires</h3>
                    <ul class="list-unstyled f-nav">
                        <li><a href="#">Devenir Partenaire</a></li>
                        <li><a href="{{ route('client.partner.index') }}">Tous les partenaires </a></li>
                        <li><a href="#">Avantages Partenaire</a></li>
                        <li><a href="#">Connexion Partenaire</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- footer area of the page -->
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-5">
                    <p>©️ 2024 - Tous droits réservés - Réalisé par Special Touch</p>
                </div>
                <div class="col-xs-12 col-sm-7">
                    <ul class="list-unstyled footer-nav">
                        <li><a href="{{ route('client.home') }}">Accueil</a></li>
                        <li><a href="#">A propos</a></li>
                        <li><a href="{{ route('client.contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
