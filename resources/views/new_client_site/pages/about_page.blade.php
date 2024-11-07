@extends('new_client_site.layouts.main')

@section('title', 'À Propos')

@section('additionnal_css')

@endsection

@section('content')

    <!-- Inner Banner -->
    <div class="inner-banner inner-banner inner-bg1">
        <div class="container">
            <div class="inner-title text-center">
                <h3>À Propos</h3>
                <ul>
                    <li>
                        <a href="{{ route('client.home') }}">Accueil</a>
                    </li>
                    <li>
                        <i class='bx bx-chevron-right'></i>
                    </li>
                    <li>À Propos</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->
    <!-- About Area -->
    <div class="about-area pt-100 pb-70">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7">
                    <div class="about-content">
                        <div class="section-title">
                            <h2>Pourquoi choisir Cadeau Rapide ?
                            </h2>
                        </div>
                        <div class="about-list">
                            <ul>
                                <li>
                                    <i class="flaticon-curve-arrow"></i>
                                    Facilité d'utilisation
                                    <br>
                                    <p>Notre plateforme intuitive vous permet de créer des chèques cadeaux en quelques
                                        clics, sans tracas.</p>
                                </li>
                                <li>
                                    <i class="flaticon-curve-arrow"></i>
                                    Personnalisation
                                    <br>
                                    <p>Vous avez la liberté de choisir le montant, d’ajouter un message personnalisé et de
                                        sélectionner les informations du destinataire.</p>
                                </li>
                                <li>
                                    <i class="flaticon-curve-arrow"></i>
                                    Variété
                                    <br>
                                    <p>Avec un large choix de partenaires, vos proches auront accès à une multitude
                                        d'options pour utiliser leur chèque cadeau.</p>
                                </li>
                                <li>
                                    <i class="flaticon-curve-arrow"></i>
                                    Notre engagement
                                    <br>
                                    <p>Nous croyons en la joie de donner et de recevoir. Chaque chèque cadeau que vous créez
                                        contribue à créer des souvenirs inoubliables. Chez Cadeau Rapide, nous nous
                                        engageons à garantir une expérience utilisateur exceptionnelle, avec une livraison
                                        rapide et sécurisée.</p>
                                </li>
                            </ul>
                        </div>

                        <div class="section-title">
                            <p>
                                Rejoignez-nous dans cette aventure de partage et d'amour, et faites plaisir à ceux qui
                                comptent le plus pour vous !
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="about-img">
                        <img src="{{ asset('assets/new_client_side/img/img_cadeau_rapide/about-choice.jpg') }}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Area End -->

    <!-- Video Area -->
    <div class="video-area video-area-bg">
        <div class="container">
            <div class="video-content">
                <h2>Pourquoi et Pour qui CadeauRapide.com ?</h2>
                <a href="javascript:void(0);" class="play-btn">
                    <i class='bx bx-play'></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Video Area End -->

    <!-- Counter Area -->
    <div class="counter-area">
        <div class="container">
            <div class="counter-bg">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-sm-6 col-md-3">
                        <div class="single-counter">
                            <h3>10 000+</h3>
                            <span>Chèques cadeaux créés</span>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-md-3">
                        <div class="single-counter">
                            <h3>98%</h3>
                            <span>Destinataires satisfaits</span>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-md-3">
                        <div class="single-counter">
                            <h3>200+</h3>
                            <span>Partenaires engagés</span>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-md-3">
                        <div class="single-counter">
                            <h3>99,5%</h3>
                            <span>Livraisons réussies</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Counter Area End -->

    <!-- Process Area -->
    <section class="process-area">
        <div class="process-into process-into-2  pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Comment ça marche ?</h2>
                    <p>Découvrez la simplicité d'envoyer des chèques cadeaux en quelques étapes. </p>
                </div>
                <div class="row pt-45">
                    <div class="col-lg-4 col-sm-6">
                        <div class="process-item">
                            <div class="process-item-number number1">1</div>
                            <i class="flaticon-position"></i>
                            <div class="content">
                                <h3>Créez votre chèque cadeau</h3>
                                <p>Sélectionnez le montant et personnalisez votre chèque cadeau avec les informations du
                                    receveur et un message spécial pour une touche personnelle.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="process-item">
                            <div class="process-item-number number2 active">2</div>
                            <i class="flaticon-to-do-list"></i>
                            <div class="content">
                                <h3>Ajoutez vos détails</h3>
                                <p>Remplissez le formulaire avec les informations nécessaires, y compris le nom et l'adresse
                                    de
                                    livraison du destinataire, pour garantir une livraison sans accroc.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6  ">
                        <div class="process-item">
                            <div class="process-item-number number3">3</div>
                            <i class="flaticon-box"></i>
                            <div class="content">
                                <h3>Livraison rapide et sécurisée</h3>
                                <p>Une fois votre chèque cadeau créé, nous nous chargeons de la livraison directement à
                                    votre
                                    proche, ou vous pouvez opter pour une version PDF à envoyer par email.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="process-line-2">
                <img src="{{ asset('assets/new_client_side/img/shape/process-line2.png') }}" alt="Images">
            </div>
        </div>
    </section>
    <!-- Process Area End -->

    <!-- Application Area -->
    <div class="application-area-two">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7">
                    <div class="application-content">
                        <div class="section-title">
                            <h2>
                                Un cadeau sur mesure pour chaque occasion.
                            </h2>
                            <p>Offrez une expérience unique en personnalisant un chèque cadeau qui correspond
                                parfaitement aux goûts et aux envies de vos proches. C'est simple, rapide et toujours
                                apprécié !</p>
                        </div>
                        <a href="{{ route('client.partner.index') }}" class="mt-4 ms-1">
                            <div class="btn btn-dark btn-content">
                                Créez votre chèque cadeau <br> <strong>dès maintenant !</strong>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="application-img-two">
                        <img src="{{ asset('assets/new_client_side/img/img_cadeau_rapide/img-cadeau-rapide-380x545.jpg') }}" alt="Images">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Application Area End -->

@endsection

@section('additionnal_js')

@endsection
