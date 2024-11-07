    <!-- Category Area End -->
    @extends('new_client_site.layouts.main')

    @section('title', 'Home')

    @section('content')
        <!-- Slider Area -->
        <div class="slider-area owl-carousel owl-theme">
            <div class="slider-item item-bg1">
                <div class="d-table">
                    <div class="d-table-cell">
                        <div class="container">
                            <div class="slider-content">
                                <h2 class="text-white">Faites plaisir à vos proches avec un chèque cadeau unique !
                                    <br> <b>Trouvez le cadeau parfait en quelques clics.</b>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Area End -->

        <!-- Banner Form Area -->
        <div class="banner-form-area banner-form-mt">
            <div class="container">
                <div class="banner-form banner-form-pl border-radius">
                    <form>
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-4">
                                <div class="form-group">
                                    <i class='flaticon-vision'></i>
                                    <input class="form-control" name="search" type="text"
                                        placeholder="Taper ici votre recherche. . .">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-2">
                                <div class="form-group">
                                    <i class='flaticon-category'></i>
                                    <select class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="$category->id">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2 col-sm-6  ">
                                <button type="submit" class="default-btn border-radius">
                                    Search
                                    <i class="flaticon-loupe"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Banner Form Area End -->

        <!-- Category Area -->
        <section class="category-area pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Explorez nos catégories pour un choix rapide et facile !</h2>
                </div>

                <div class="row category-bg">
                    @foreach ($categories as $category)
                        <div class="col-lg-2 col-sm-4">
                            <div class="category-box-card">
                                <a href="{{ route('client.partner.category', ['name' => $category->name]) }}">
                                    <i class="{{ $category->icon }}"></i>
                                </a>
                                <h3><a
                                        href="{{ route('client.partner.category', ['name' => $category->name]) }}">{{ $category->name }}</a>
                                </h3>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- Category Area End -->

        <!-- Process Area -->
        <section class="process-area process-bg pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Comment ça marche ?</h2>
                    <p>Découvrez la simplicité d'envoyer des chèques cadeaux en quelques étapes. </p>
                </div>
                <div class="row pt-45">
                    <div class="col-lg-4 col-sm-6">
                        <div class="process-card">
                            <i class="flaticon-position icon-bg"></i>
                            <h3>Créez votre chèque cadeau</h3>
                            <p>Sélectionnez le montant et personnalisez votre chèque cadeau avec les informations du
                                receveur et un message spécial pour une touche personnelle.
                            </p>
                            <div class="process-number">
                                1
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="process-card">
                            <i class="flaticon-to-do-list icon-bg"></i>
                            <h3>Ajoutez vos détails</h3>
                            <p>Remplissez le formulaire avec les informations nécessaires, y compris le nom et l'adresse de
                                livraison du destinataire, pour garantir une livraison sans accroc.
                            </p>
                            <div class="process-number active">
                                2
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6  ">
                        <div class="process-card">
                            <i class="flaticon-box icon-bg"></i>
                            <h3>Livraison rapide et sécurisée</h3>
                            <p>Une fois votre chèque cadeau créé, nous nous chargeons de la livraison directement à votre
                                proche, ou vous pouvez opter pour une version PDF à envoyer par email.</p>
                            <div class="process-number">
                                3
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Process Area End -->

        <!-- Video Area -->
        <div class="video-area video-area-bg">
            <div class="container">
                <div class="video-content">
                    <h2>Pourquoi et Pour qui CadeauRapide.com ?</h2>
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

        <!-- Place Area -->
        <div class="place-area pt-100 pb-70">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="section-title mb-45">
                            <span>Partenaires</span>
                            <h2>Nos meilleurs partenaires</h2>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="place-btn">
                            <a href="{{ route('client.partner.index') }}" class="default-btn border-radius">
                                Voir tous nos partenaires
                                <i class='bx bx-plus'></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    @foreach ($topPartners as $partner)
                        <div class="col-lg-4 col-md-6">
                            <div class="place-card">
                                <a href="{{ route('client.partner.show', ['slug' => $partner->slug]) }}"
                                    class="place-images">
                                    <img src="{{ route('client.image.show', ['filename' => str_replace('Partners/', '', $partner->picture_2), 'w' => 550, 'h' => 780, 'fit' => 'crop']) }}"
                                        alt="{{ $partner->name }}">
                                </a>
                                <div class="status-tag bg-dark-orange">
                                    <a href="{{ route('client.partner.category', ['name' => $partner->category->name]) }}">
                                        <h3>{{ $partner->category->name }}</h3>
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="content-profile">
                                        <img src="{{ route('client.image.show', ['filename' => str_replace('Partners/', '', $partner->picture_1), 'w' => 35, 'h' => 35, 'fit' => 'crop']) }}"
                                            alt="Images">
                                        <a href="{{ route('client.partner.show', ['slug' => $partner->slug]) }}">
                                            <h3>{{ $partner->name }}</h3>
                                        </a>
                                    </div>
                                    <span>
                                        <i class="flaticon-cursor"></i>
                                        {{ $partner->address ? $partner->address : 'Non spécifié' }}
                                    </span>
                                    <p>{{ substr($partner->description, 0, 90) }}</p>

                                    <div class="content-tag">
                                        <ul>
                                            @php
                                                $tags = explode(', ', $partner->tags);
                                            @endphp
                                            @for ($i = 0; $i < 3; $i++)
                                                <li class="chip me-2 mb-2">{{ $tags[$i] }}</li>
                                            @endfor
                                        </ul>
                                        <h3 class="price"><a href="javascript:void(0);">À
                                                partir de: {{ number_format($partner->min_amount, 0, '', ' ') }}XOF</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Place Area End -->

        <!-- Application Area -->
        <div class="application-area pt-100">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-5">
                        <div class="application-img">
                            <img src="{{ asset('assets/new_client_side/img/img_cadeau_rapide/img-cadeau-rapide.jpg') }}" alt="Images">
                        </div>
                    </div>
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
                </div>
            </div>
        </div>
        <!-- Application Area End -->

        <!-- Testimonial Area -->
        <section class="testimonial-area pb-70">
            <div class="container-fluid">
                <div class="section-title text-center">
                    <span>Temoignages</span>
                    <h2>Ce que pensent nos clients</h2>
                </div>

                <div class="testimonial-slider owl-carousel owl-theme">
                    <div class="testimonial-item testimonial-item-bg">
                        <h3>Aïcha Adégbè</h3>
                        <span>Infirmière</span>
                        <p>Créer un chèque cadeau pour l'anniversaire de mon ami a été un vrai jeu d'enfant. Il a adoré le
                            cadeau personnalisé et l'expérience a été fantastique !</p>
                        <ul class="rating">
                            <li>
                                <i class='bx bxs-star'></i>
                            </li>
                            <li>
                                <i class='bx bxs-star'></i>
                            </li>
                            <li>
                                <i class='bx bxs-star'></i>
                            </li>
                            <li>
                                <i class='bx bxs-star'></i>
                            </li>
                            <li>
                                <i class='bx bxs-star'></i>
                            </li>
                        </ul>

                        <div class="testimonial-top">
                            <i class='bx bxs-quote-left'></i>
                        </div>
                    </div>
                    <div class="testimonial-item testimonial-item-bg">
                        <h3>Kofi Dossou</h3>
                        <span>Commerçant</span>
                        <p>J'ai utilisé ce service pour offrir un chèque cadeau à ma sœur. La facilité d'utilisation et la
                            rapidité de livraison m'ont impressionné. Je recommande vivement !</p>
                        <ul class="rating">
                            <li>
                                <i class='bx bxs-star'></i>
                            </li>
                            <li>
                                <i class='bx bxs-star'></i>
                            </li>
                            <li>
                                <i class='bx bxs-star'></i>
                            </li>
                            <li>
                                <i class='bx bxs-star'></i>
                            </li>
                            <li>
                                <i class='bx bxs-star'></i>
                            </li>
                        </ul>

                        <div class="testimonial-top">
                            <i class='bx bxs-quote-left'></i>
                        </div>
                    </div>
                    <div class="testimonial-item testimonial-item-bg">
                        <h3>Céline Houéton</h3>
                        <span>Étudiante</span>
                        <p>Les chèques cadeaux personnalisés sont une idée brillante ! J'ai pu surprendre mes amis avec des
                            cadeaux uniques, et ils ont tous été ravis.</p>
                        <ul class="rating">
                            <li>
                                <i class='bx bxs-star'></i>
                            </li>
                            <li>
                                <i class='bx bxs-star'></i>
                            </li>
                            <li>
                                <i class='bx bxs-star'></i>
                            </li>
                            <li>
                                <i class='bx bxs-star'></i>
                            </li>
                            <li>
                                <i class='bx bxs-star'></i>
                            </li>
                        </ul>

                        <div class="testimonial-top">
                            <i class='bx bxs-quote-left'></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonial Area End -->

    @endsection
