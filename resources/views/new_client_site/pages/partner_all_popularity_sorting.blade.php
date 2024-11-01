@extends('new_client_site.layouts.main')

@section('title', 'Home')

@section('content')
    <!-- Inner Banner -->
    <div class="inner-banner inner-bg3">
        <div class="container">
            <div class="inner-banner-title text-center">
                <h3>Ridgi Fitness Club</h3>
                <p>News pariatur. Excepteur sint occaecat iat nulla pariatur.Excepteur </p>
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
                        {{-- <p>Results for: <a href="#">Listings</a></p> --}}
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
                    <div class="listing-section-right">
                        <h3 class="title"> <i class="flaticon-filter"></i> Filters</h3>
                        <div class="listing-right-form">
                            <form>
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <i class='flaticon-loupe'></i>
                                            <input type="text" class="form-control" placeholder="What Are Searching*">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="facilities-list">
                            <h3 class="facilities-title"> Facilities</h3>
                            <ul>
                            </ul>
                        </div>
                        <div class="col-lg-12 col-md-12 text-center">
                            <button type="submit" class="default-btn border-radius">
                                Search Result
                            </button>
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
                                                    <option value="alphabetically">Ordre alphabétique</option>
                                                    <option value="popularity" selected>Popularité</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-3">
                            </div>
                        </div>

                        <div class="row justify-content-center mt-2">

                            @foreach ($partners as $partner)
                                <div class="col-lg-6 col-md-6">
                                    <div class="place-card active">
                                        <a href="{{ route('client.partner.show', ['partner_name' => $partner->name]) }}"
                                            class="place-images">
                                            <img src="{{ route('client.image.show', ['filename' => str_replace('Partners/', '', $partner->picture_2), 'w' => 550, 'h' => 750, 'fit' => 'crop']) }}"
                                                alt="Images">
                                        </a>
                                        <div class="rating">
                                        </div>
                                        <div class="status-tag bg-color-blue">
                                            <a
                                                href="{{ route('client.partner.category', ['name' => $partner->category->name]) }}">
                                                <h3>{{ $partner->category->name }}</h3>
                                            </a>
                                        </div>
                                        <div class="content content-bg ">
                                            <div class="content-profile">
                                                <img src="{{ route('client.image.show', ['filename' => str_replace('Partners/', '', $partner->picture_1), 'w' => 50, 'h' => 50, 'fit' => 'crop']) }}"
                                                    alt="Images">
                                                <h3>{{ $partner->name }}</h3>
                                            </div>
                                            <span>
                                                <i class="flaticon-cursor"></i>
                                                {{ $partner->adress ? $partner->adress : 'Non spécifiée' }}
                                            </span>
                                            <a
                                                href="{{ route('client.partner.show', ['partner_name' => $partner->name]) }}">
                                                <h3>{{ $partner->short_description }}</h3>
                                            </a>
                                            <p>{{ substr($partner->description, 0, 120) }}</p>
                                            <div class="content-tag">
                                                <ul>
                                                    @php
                                                        $tags = explode(', ', $partner->tags);
                                                    @endphp
                                                    @for ($i = 0; $i < 3; $i++)
                                                        <li class="chip me-2 mb-2">{{ $tags[$i] }}</li>
                                                    @endfor
                                                </ul>
                                                <h3 class="price"><a href="#">À
                                                        partir de:
                                                        {{ number_format($partner->min_amount, 0, '', ' ') }}XOF</a>
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
