@extends('new_client_site.layouts.main')

@section('content')
    <!-- Inner Banner -->
    <div class="inner-banner inner-bg1">
        <div class="container">
            <div class="inner-banner-title text-center">
                <h3>{{ $category->name }}</h3>
                <p>{{ $category->short_description }}</p>
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
                            <li>Catégorie</li>
                            <li>
                                <i class='bx bx-chevron-right'></i>
                            </li>
                            <li class="active">{{ $category->name }}</li>
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
                <div class="col-lg-11">
                    <div class="listing-widget-into">
                        <div class="">
                            <div class="listing-right-form">
                                <div class="row justify-content-center">
                                    <div class="form-group col-lg-1 col-sm-4">
                                        <label>Trier par:</label>
                                    </div>
                                    <div class="col-lg-8 col-sm-8">
                                        <div class="form-group">
                                            <i class='flaticon-filter'></i>
                                            <select class="form-control" id="order_by">
                                                <option value="alphabetically">Ordre alphabétique</option>
                                                <option value="popularity">Popularité</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        @foreach ($partners as $partner)
                            <div class="col-lg-4 col-md-2 col-xs-1">
                                <div class="place-card active">
                                    <a href="{{ route('client.partner.show', ['slug' => $partner->slug]) }}"
                                        class="place-images">
                                        <img src="{{ route('client.image.show', ['filename' => str_replace('Partners/', '', $partner->picture_2), 'w' => 550, 'h' => 750, 'fit' => 'crop']) }}"
                                            alt="Images">
                                    </a>
                                    <div class="status-tag bg-dark-orange">
                                        <a
                                            href="{{ route('client.partner.category', ['name' => $partner->category->name]) }}">
                                            <h3>{{ $partner->category->name }}</h3>
                                        </a>
                                    </div>
                                    <a href="{{ route('client.partner.show', ['slug' => $partner->slug]) }}">
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
                                            <p>{{ substr($partner->description, 0, 90) }}</p>
                                            <div class="content-tag">
                                                <ul>
                                                    @php
                                                        $tags = explode(', ', $partner->tags);
                                                    @endphp
                                                    @for ($i = 0; $i < count($tags); $i++)
                                                        <li class="chip me-2 mb-2">{{ $tags[$i] }}</li>
                                                    @endfor
                                                </ul>
                                                <h3 class="price"><a href="javascript:void(0);">À
                                                        partir de:
                                                        {{ number_format($partner->min_amount, 0, '', ' ') }}XOF</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- pagination of the page -->
                    <div class="col-lg-12 text-center">
                        {{-- <a href="javascript:void(0);" class="default-btn border-radius">
                            Load More
                            <i class='bx bx-plus'></i>
                        </a> --}}

                        {{ $partners->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Listing Widget Section End -->

    <!-- Category Area -->
    <section class="category-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Explorez nos catégories pour un choix rapide et facile !</h2>
            </div>

            <div class="category-bg category-container">
                @foreach ($categories as $category)
                    <div class="mb-4 text-center">
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
@endsection

@section('additionnal_js')
    <script>
        $('#order_by').on('change', function() {
            if ($(this).val() == 'popularity') window.location.href =
                "{{ route('client.partner.category', ['name' => $category->name, 'sortBy' => 'poularity']) }}"
            else if ($(this).val() == 'alphabetically') window.location.href =
                "{{ route('client.partner.category', ['name' => $category->name]) }}"
        });
    </script>
@endsection
