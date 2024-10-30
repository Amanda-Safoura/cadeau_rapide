@extends('new_client_site.layouts.main')

@section('title', 'Page Partenaire')

@section('additionnal_css')
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }

        .partner-page {
            margin-top: 20px;
        }

        .partner-name {
            font-size: 2em;
            color: #333;
        }

        .partner-category,
        .partner-short-description {
            font-size: 1.2em;
            color: #666;
        }

        .partner-description {
            margin-top: 15px;
            font-size: 1em;
            color: #555;
        }

        .contact-info p,
        .offers p,
        .min-amount {
            font-size: 1em;
            margin-bottom: 10px;
        }

        .btn-order {
            margin-top: 20px;
            background-color: #5cb85c;
            border-color: #4cae4c;
            color: #fff;
            font-size: 1.2em;
        }

        .btn-order:hover {
            background-color: #4cae4c;
            border-color: #4cae4c;
        }

        .gallery {
            margin-top: 20px;
        }

        .img-thumbnail {
            max-height: 150px;
            width: auto;
        }

        .main-img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 5px;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            font-size: 0.9em;
            color: #333;
            background-color: #f0f0f0;
            border-radius: 15px;
            margin: 5px;
            text-align: center;
            margin-bottom: 10px;
        }

        .badge-container {
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')

    <section class="banner banner3 bg-full overlay"
        style="background-image: url({{ asset('assets/backoffice/img/photos/unsplash-1.jpg') }});">
        <div class="holder">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>Page Partenaire</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="container pad-top-lg pad-bottom-lg">
                <div class="partner-page">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="thumbnail">
                                <img src="{{ Storage::disk('public')->url($partner->picture_1) }}" alt="Image principale"
                                    class="img-responsive main-img">
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <h1 class="partner-name">Nom du Partenaire: <span id="name">{{ $partner->name }}</span>
                            </h1>
                            <p class="partner-category"><strong>Catégorie:</strong> <span
                                    id="category">{{ $partner->category->name }}</span>
                            </p>
                            <p class="partner-short-description"><strong>À propos:</strong> <span
                                    id="short_description">{{ $partner->short_description }}</span></p>
                            <p class="partner-description" id="description">{{ $partner->description }}</p>
                            <div class="contact-info">
                                <p><strong>Téléphone:</strong> <span id="phone_number">{{ $partner->phone_number }}</span>
                                </p>
                                <p><strong>Email:</strong> <a href="mailto:{{ $partner->email }}"
                                        id="email">{{ $partner->email }}</a></p>
                                <p><strong>Adresse:</strong> <span id="adress">{{ $partner->adress }}</span>
                                </p>
                            </div>
                            <div class="offers">
                                <h3>Offres</h3>
                                <p id="offers">
                                <ul>
                                    @php
                                        $offers = explode('--separator--', $partner->offers);
                                    @endphp
                                    @foreach ($offers as $key => $offer)
                                        @if ($key + 1 != count($offers))
                                            <li>{{ $offer }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                                </p>
                            </div>
                            <div class="tags">
                                <strong>Tags:</strong> <span id="tags">
                                    <div class="badge-container">
                                        @foreach (explode(', ', $partner->tags) as $tag)
                                            <span class="badge">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                </span>
                            </div>
                            <p class="min-amount"><strong>Montant minimum:</strong> <span
                                    id="min_amount">{{ $partner->min_amount }}</span></p>
                            <a href="{{route('client.partner.ordering_page', ['partner_name' => $partner->name])}}" class="btn btn-primary btn-order">Commander un chèque cadeau</a>
                        </div>
                    </div>
                    <div class="row gallery">
                        <div class="col-xs-6 col-md-3">
                            <img src="{{ Storage::disk('public')->url($partner->picture_2) }}" alt="Image 2"
                                class="img-thumbnail">
                        </div>
                        <div class="col-xs-6 col-md-3">
                            <img src="{{ Storage::disk('public')->url($partner->picture_3) }}" alt="Image 3"
                                class="img-thumbnail">
                        </div>
                        <div class="col-xs-6 col-md-3">
                            <img src="{{ Storage::disk('public')->url($partner->picture_4) }}" alt="Image 4"
                                class="img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
