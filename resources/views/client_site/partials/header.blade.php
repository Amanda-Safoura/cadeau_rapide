<header id="header" class="header2">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="border">
                    <div class="logo">
                        <a href="{{ route('client.home') }}"><img src="{{ asset('assets/LOGO CADEAURAPIDE.png') }}"
                                alt="Coupmy" class="img-resposnive"></a>
                    </div>
                    <!-- nav holder of the page -->
                    <div class="nav-holder">
                        <a href="#" class="nav-opener hidden-lg visible"><i class="fa fa-bars"></i></a>
                        <!-- nav of the page -->
                        <nav id="nav">
                            <ul class="list-unstyled">
                                <li><a href="#">A propos</a></li>
                                <li>
                                    <a href="{{route('client.partner.index')}}">Partenaires</a>
                                </li>
                                <li><a href="#">À Propos</a></li>
                                <li><a href="{{ route('client.contact') }}">Contact</a></li>
                                @guest
                                    <li class="visible-xs hidden"><a href="{{ route('client.login_page') }}">Se connecter</a></li>
                                    <li class="visible-xs hidden"><a href="{{ route('client.register_page') }}">S'inscrire</a>
                                    </li>
                                @endguest
                                @auth
                                    <li class="visible-xs hidden">
                                        <a href="{{ route('client.profile_page') }}">Profil</a>
                                    </li>
                                    <li class="visible-xs hidden">
                                        <form action="{{ route('client.logout') }}" method="post">
                                            @csrf
                                            <button type="submit" style="all: unset; cursor: pointer">Déconnexion</button>
                                        </form>
                                    </li>
                                @endauth
                            </ul>
                        </nav>
                        @guest
                            <ul class="align-left list-unstyled text-uppercase hidden-xs login-section">
                                <li><a href="{{ route('client.login_page') }}">Se connecter</a></li>
                                <li>|</li>
                                <li><a href="{{ route('client.register_page') }}">S'inscrire</a></li>
                            </ul>
                        @endguest
                        @auth
                            <ul class="align-left list-unstyled text-uppercase hidden-xs">
                                <li>
                                    <a href="{{ route('client.profile_page') }}">Profil</a>
                                </li>
                                <li>|</li>
                                <li>
                                    <form action="{{ route('client.logout') }}" method="post">
                                        @csrf
                                        <button type="submit" style="all: unset; cursor: pointer">Déconnexion</button>
                                    </form>
                                </li>
                            </ul>
                        @endauth
                        <a href="#" class="btn-primary text-center text-uppercase md-round hidden-xs">Devenez
                            Partenaire</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
