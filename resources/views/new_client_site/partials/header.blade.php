<div class="navbar-area">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="{{ route('client.home') }}" class="logo">
            <img src="{{ asset('assets/LOGO CADEAURAPIDE.png') }}" alt="Logo">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container-fluid">
            <nav class="container-max navbar navbar-expand-md navbar-light ">
                <a class="navbar-brand" href="index.html">
                    <img src="{{ asset('assets/LOGO CADEAURAPIDE.png') }}" alt="Logo">
                </a>

                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a href="{{ route('client.home') }}" class="nav-link active">
                                Accueil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('client.partner.index') }}" class="nav-link">
                                Partenaires
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                À Propos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('client.contact') }}" class="nav-link">
                                Contact
                            </a>
                        </li>
                    </ul>

                    <div class="side-nav d-in-line align-items-center">
                        <div class="side-item">
                            <div class="nav-add-btn">
                                <a href="{{ route('client.contact') }}" class="default-btn border-radius">
                                    Devenez Partenaire
                                </a>
                            </div>
                        </div>

                        <div class="side-item">
                            <div class="search-box">
                                <i class="flaticon-loupe"></i>
                            </div>
                        </div>

                        <div class="side-item">
                            <div class="user-btn">
                                <a href="login-register.html">
                                    <i class="flaticon-contact"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="side-nav-responsive">
        <div class="container">
            <div class="dot-menu">
                <div class="circle-inner">
                    <div class="circle circle-one"></div>
                    <div class="circle circle-two"></div>
                    <div class="circle circle-three"></div>
                </div>
            </div>

            <div class="container">
                <div class="side-nav-inner">
                    <div class="side-nav justify-content-center  align-items-center">

                        <div class="side-item">
                            <div class="search-box">
                                <i class="flaticon-loupe"></i>
                            </div>
                        </div>

                        <div class="side-item">
                            <div class="user-btn">
                                @guest

                                    <a href="{{ route('client.login_page') }}">
                                        <i class="flaticon-contact"></i>
                                    </a>
                                @endguest
                                @auth
                                    <a href="{{ route('client.profile_page') }}">
                                        <i class="flaticon-contact"></i>
                                    </a>
                                @endauth
                            </div>
                        </div>

                        @auth
                            <div class="side-item">
                                <div class="user-btn">
                                    <form action="{{ route('client.logout') }}" method="post">
                                        @csrf
                                        <button type="submit"><a
                                                href="https://www.flaticon.com/fr/icones-gratuites/se-deconnecter"></a></button>
                                    </form>
                                </div>
                            </div>
                        @endauth
                        <div class="side-item">
                            <div class="nav-add-btn">
                                <a href="{{ route('client.contact') }}" class="default-btn border-radius">
                                    Devenez Partenaire
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
