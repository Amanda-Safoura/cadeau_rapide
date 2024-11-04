@extends('new_client_site.layouts.main')

@section('title', 'Page Partenaire')

@section('additionnal_css')
@endsection

@section('content')

    <!-- Inner Banner -->
    <div class="inner-banner inner-bg4">
        <div class="container">
            <div class="inner-banner-title text-center">
                <h3>{{ $partner->name }}</h3>
                <p>{{ $partner->short_description }}</p>
            </div>

            <div class="banner-list">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6 col-md-7">
                        <ul class="list">
                            <li>
                                <a href="{{ route('client.partner.index') }}">Partenaires</a>
                            </li>
                            <li>
                                <i class='bx bx-chevron-right'></i>
                            </li>
                            <li class="active">Page de présentation</li>
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-5">
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
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Blog Details Area -->
    <div class="blog-details-area pt-100 pb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="blog-article">
                        <div class="article-comment-area">
                            <div class="article-img">
                                <img src="{{ route('client.image.show', ['filename' => str_replace('Partners/', '', $partner->picture_2), 'w' => 1140, 'h' => 560, 'fit' => 'crop']) }}"
                                    alt="Images">
                            </div>

                            <ul class="article-comment">
                                <li>
                                    <div class="image">
                                        <img src="{{ route('client.image.show', ['filename' => str_replace('Partners/', '', $partner->picture_1), 'w' => 50, 'h' => 50, 'fit' => 'crop']) }}"
                                            alt="Images">
                                    </div>
                                    <div class="content">
                                        <h3>{{ $partner->name }}</h3>
                                        <span>Actif depuis: {{ date_format($partner->created_at, 'd F Y') }}</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="content-list">
                                        <h3>Ventes</h3>
                                        <span>{{ $partner->giftCards()->count() }}</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="content-list">
                                        <h3>Catégorie</h3>
                                        <span>{{ $partner->category->name }}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="article-content">
                            <h3>{{ $partner->short_description }}</h3>
                            <p>
                                {{ $partner->description }}
                            </p>

                            {{-- <blockquote class="blockquote">
                                <p>
                                    Information Without Cross-media Value. Quickly Maximize Timely
                                    Deliverables For Real-time Schemas. Dramatically Maintain Clicks
                                </p>
                            </blockquote> --}}

                            @php
                                $tags = explode(', ', $partner->tags);
                            @endphp
                            <div class="blog-tag">
                                <ul>
                                    <li class="active">Tags:</li>
                                    @foreach ($tags as $tag)
                                        <li><a href="javascrip:void(0);">#{{ $tag }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="listing-widget gallery-slider">
                        <h3 class="title">Gallery / Photos</h3>
                        <div class="gallery-slider-area owl-carousel owl-theme">
                            <div class="Gallery-item">
                                <a href="{{ Storage::disk('public')->url($partner->picture_1) }}"><img
                                        src="{{ route('client.image.show', ['filename' => str_replace('Partners/', '', $partner->picture_1), 'w' => 550, 'h' => 320, 'fit' => 'crop']) }}"
                                        alt="Images"></a>
                            </div>
                            @if ($partner->picture_2)
                                <div class="Gallery-item">
                                    <a href="{{ Storage::disk('public')->url($partner->picture_2) }}"><img
                                            src="{{ route('client.image.show', ['filename' => str_replace('Partners/', '', $partner->picture_2), 'w' => 550, 'h' => 320, 'fit' => 'crop']) }}"
                                            alt="Images"></a>
                                </div>
                            @endif

                            @if ($partner->picture_3)
                                <div class="Gallery-item">
                                    <a href="{{ Storage::disk('public')->url($partner->picture_3) }}"><img
                                            src="{{ route('client.image.show', ['filename' => str_replace('Partners/', '', $partner->picture_3), 'w' => 550, 'h' => 320, 'fit' => 'crop']) }}"
                                            alt="Images"></a>
                                </div>
                            @endif

                            @if ($partner->picture_4)
                                <div class="Gallery-item">
                                    <a href="{{ Storage::disk('public')->url($partner->picture_4) }}"><img
                                            src="{{ route('client.image.show', ['filename' => str_replace('Partners/', '', $partner->picture_4), 'w' => 550, 'h' => 320, 'fit' => 'crop']) }}"
                                            alt="Images"></a>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <a href="{{ route('client.partner.ordering_page', ['slug' => $partner->slug]) }}"
                            class="default-btn border-radius">
                            Commander un chèque cadeau
                        </a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="blog-widget-left">

                        <div class="blog-widget-profile">
                            <div class="card text-bg-dark">
                                <img src="{{ asset('assets/backoffice/img/photos/unsplash-3.jpg') }}"
                                    class="card-img opacity-25" alt="...">
                                <div class="card-img-overlay border-none">
                                    <a href="{{ route('client.contact') }}">
                                        <div class="row col-12">
                                            <h5 class="card-title"><i class="fas fa-handshake text-white"
                                                    style="font-size: 50px"></i>
                                            </h5>
                                            <h2 class="text-uppercase" style="color: #e7b50a"><strong>Devenez
                                                    Partenaire</strong></h2>
                                            <h4 class="text-center text-uppercase text-white">Rejoignez-nous</h4>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>

                        <div class="blog-widget">
                            <h3 class="title">Catégories</h3>
                            <div class="widget_categories">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="{{ route('client.partner.category', ['name' => $category->name]) }}">{{ $category->name }}
                                                <span>({{ $category->partners->count() }})</span></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="listing-widget-side">
                        <h3 class="title">Contact</h3>
                        <ul class="listing-widget-list">
                            <li>Address : <span> {{ $partner->adress }}</span></li>
                            <li>Phone : <span><a
                                        href="tel:{{ $partner->phone_number }}">{{ $partner->phone_number }}</a></span>
                            </li>
                            <li>Mail : <span><a href="mailto:{{ $partner->email }}">{{ $partner->email }}</a></span></li>
                        </ul>
                        <ul class="social-link">
                            <li>
                                <a href="https://www.facebook.com/login/" target="_blank"><i
                                        class="bx bxl-facebook"></i></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/i/flow/login" target="_blank"><i
                                        class="bx bxl-twitter"></i></a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/accounts/login/" target="_blank"><i
                                        class="bx bxl-instagram"></i></a>
                            </li>
                            <li>
                                <a href="https://www.pinterest.com/" target="_blank"><i
                                        class="bx bxl-pinterest-alt"></i></a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/" target="_blank"><i class="bx bxl-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="listing-widget-side">
                        <h3 class="title">Ordre de prix</h3>
                        <h3 class="price-title">Prix : <span>{{ $partner->min_amount }}</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Details Area End -->
@endsection
