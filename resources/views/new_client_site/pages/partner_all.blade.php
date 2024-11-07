@extends('new_client_site.layouts.main')

@section('title', 'Accueil')

@section('content')



    <!-- Inner Banner -->
    <div class="inner-banner inner-bg1">
        <div class="container">
            <div class="inner-banner-title text-center">
                <h3>Nos Partenaires</h3>
            </div>

            <div class="banner-list">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6 col-md-7">
                        <ul class="list">
                            <li>
                                <a href="{{ route('client.partner.index') }}">Partenaires</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-5">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Listing Widget Section -->
    <div class="listing-widget-section pt-100 pb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="listing-section-right pt-4">
                        <div class="facilities-list">
                            <h3 class="facilities-title">Catégories</h3>
                            <ul>
                                @foreach ($categories as $category)
                                    <li>
                                        <a class="text-secondary"
                                            href="{{ route('client.partner.category', ['name' => $category->name]) }}">{{ $category->name }}
                                            <span>({{ $category->partners->count() }})</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <h3 class="title"> <i class="flaticon-loupe"></i>Recherche</h3>
                        <div class="listing-right-form">
                            <form action="{{ route('client.partner.search') }}" method="get">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <i class='flaticon-loupe'></i>
                                            <input type="text" name="search" class="form-control"
                                                placeholder="What Are Searching*">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 text-center">
                                        <button type="submit" class="default-btn border-radius">
                                            Rechercher
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="listing-widget-into">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-lg-9 col-sm-9">
                                <div class="listing-right-form">
                                    <div class="row justify-content-center">
                                        <div class="form-group">
                                            <label>Sort by:</label>
                                        </div>
                                        <div class="col-lg-7 col-sm-8">
                                            <div class="form-group">
                                                <i class='flaticon-filter'></i>
                                                <select class="form-control" id="order_by">
                                                    <option value="alphabetically" selected>Ordre alphabétique</option>
                                                    <option value="popularity">Popularité</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-3">
                            </div>
                        </div>

                        <div class="container p-4 mb-3">
                            <!-- Icône circulaire -->
                            @foreach ($groupedPartners as $letter => $partner)
                                <a href="{{ route('client.partner.letter', ['letter' => $letter]) }}">
                                    <div class="d-flex align-items-center justify-content-center bg-secondary text-white rounded-circle"
                                        style="width: 40px; height: 40px;">
                                        <span>{{ $letter }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        @foreach ($groupedPartners as $letter => $letterPartners)
                            <div
                                class="d-flex align-items-center justify-content-between p-3 border rounded bg-light shadow-sm">
                                <!-- Texte principal -->
                                <div class="ms-3 fw-bold text-dark">
                                    {{ $letter }}
                                </div>

                                <!-- Lien pour les partenaires -->
                                <a href="{{ route('client.partner.letter', ['letter' => $letter]) }}"
                                    class="text-danger small text-decoration-none">{{ $letterPartners->count() }}
                                    partenaire(s)</a>
                            </div>

                            <div class="row justify-content-center mt-2">

                                @foreach ($letterPartners as $oneLetterPartner)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="place-card active">
                                            <a href="{{ route('client.partner.show', ['slug' => $oneLetterPartner->slug]) }}"
                                                class="place-images">
                                                <img src="{{ route('client.image.show', ['filename' => str_replace('Partners/', '', $oneLetterPartner->picture_2), 'w' => 550, 'h' => 750, 'fit' => 'crop']) }}"
                                                    alt="Images">
                                            </a>
                                            <div class="rating">
                                            </div>
                                            <div class="status-tag bg-dark-orange">
                                                <a
                                                    href="{{ route('client.partner.category', ['name' => $oneLetterPartner->category->name]) }}">
                                                    <h3>{{ $oneLetterPartner->category->name }}</h3>
                                                </a>
                                            </div>
                                            <div class="content content-bg ">
                                                <div class="content-profile">
                                                    <img src="{{ route('client.image.show', ['filename' => str_replace('Partners/', '', $oneLetterPartner->picture_1), 'w' => 50, 'h' => 50, 'fit' => 'crop']) }}"
                                                        alt="Images">
                                                    <h3>{{ $oneLetterPartner->name }}</h3>
                                                </div>
                                                <span>
                                                    <i class="flaticon-cursor"></i>
                                                    {{ $oneLetterPartner->adress ? $oneLetterPartner->adress : 'Non spécifiée' }}
                                                </span>
                                                <p>{{ substr($oneLetterPartner->description, 0, 120) }}</p>
                                                <div class="content-tag">
                                                    <ul>
                                                        @php
                                                            $tags = explode(', ', $oneLetterPartner->tags);
                                                        @endphp
                                                        @for ($i = 0; $i < 3; $i++)
                                                            <li class="chip me-2 mb-2">{{ $tags[$i] }}</li>
                                                        @endfor
                                                    </ul>
                                                    <h3 class="price"><a href="javascript:void(0);">À
                                                            partir de:
                                                            {{ number_format($oneLetterPartner->min_amount, 0, '', ' ') }}XOF</a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-lg-12 text-center">
                                    {{ $partners->links() }}
                                </div>
                            </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Listing Widget Section End -->
@endsection

@section('additionnal_js')
    <script>
        $('#order_by').on('change', function() {
            if ($(this).val() == 'popularity') window.location.href =
                "{{ route('client.partner.popularity_sorting.index') }}"
            else if ($(this).val() == 'alphabetically') window.location.href =
                "{{ route('client.partner.index') }}"
        });
    </script>
@endsection
