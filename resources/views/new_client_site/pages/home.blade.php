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
                            <h1>Explore Places In Suburb
                                <b>Keep Choose Best</b>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="slider-item item-bg2">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="slider-content">
                            <h1>Find Best The Restaurants
                                <b>In Your Choose</b>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-item item-bg3">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="slider-content">
                            <h1>Discover The Exact Event
                                <b>In Your Choose</b>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-item item-bg4">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="slider-content">
                            <h1>Find The Amazing Hotel
                                <b>Keep Your Choose</b>
                            </h1>
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
                <span>The Categories</span>
                <h2>Use Quick Search By Category</h2>
            </div>

            <div class="row category-bg">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-sm-6">
                        <div class="category-card">
                            <a href="{{ route('client.partner.category', ['name' => $category->name]) }}">
                                <i class="flaticon-bake"></i>
                            </a>

                            <a href="category.html">
                                <h3>{{ $category->name }}</h3>
                            </a>
                            <p>{{ $category->short_description }}</p>
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
                <span>Process</span>
                <h2>See How It Works</h2>
                <p>Porem ipsum dolor sit ame consectetur adipisicing incididunt </p>
            </div>
            <div class="row pt-45">
                <div class="col-lg-4 col-sm-6">
                    <div class="process-card">
                        <i class="flaticon-position icon-bg"></i>
                        <h3>Find Interesting Place</h3>
                        <p>Lorem ipsum dolor sit amet, consetetur adipisicing elit, sed do eiusmod tempor quam
                            voluptatem.</p>
                        <div class="process-number">
                            1
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="process-card">
                        <i class="flaticon-to-do-list icon-bg"></i>
                        <h3>Choose What To Do</h3>
                        <p>Lorem ipsum dolor sit amet, consetetur adipisicing elit, sed do eiusmod tempor quam
                            voluptatem.</p>
                        <div class="process-number active">
                            2
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6  ">
                    <div class="process-card">
                        <i class="flaticon-box icon-bg"></i>
                        <h3>Find What You Want</h3>
                        <p>Lorem ipsum dolor sit amet, consetetur adipisicing elit, sed do eiusmod tempor quam
                            voluptatem.</p>
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
                <h2>Are You Ready To Start Your Journey?</h2>
                <a href="https://www.youtube.com/watch?v=07d2dXHYb94&t=6s" class="play-btn">
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
                            <h3>1254</h3>
                            <span>New Visiters Every Week</span>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-md-3">
                        <div class="single-counter">
                            <h3>23165</h3>
                            <span>New Visiters Every Day</span>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-md-3">
                        <div class="single-counter">
                            <h3>4563</h3>
                            <span>Won Amazing Awards</span>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-md-3">
                        <div class="single-counter">
                            <h3>880</h3>
                            <span>New Listing Every Week</span>
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
                            <a href="{{ route('client.partner.category', ['name' => $partner->category->name]) }}"
                                class="place-images">
                                <img src="{{ route('client.image.show', ['filename' => str_replace('Partners/', '', $partner->picture_3), 'w' => 550, 'h' => 780, 'fit' => 'crop']) }}"
                                    alt="{{ $partner->name }}">
                            </a>
                            <div class="rating">
                            </div>
                            <div class="status-tag bg-dark-orange">
                                <a href="{{ route('client.partner.show', ['partner_name' => $partner->name]) }}">
                                    <h3>{{ $partner->category->name }}</h3>
                                </a>
                            </div>
                            <div class="content">
                                <div class="content-profile">
                                    <img src="{{ route('client.image.show', ['filename' => str_replace('Partners/', '', $partner->picture_1), 'w' => 35, 'h' => 35, 'fit' => 'crop']) }}"
                                        alt="Images">
                                    <h3>{{ $partner->name }}</h3>
                                </div>
                                <span>
                                    <i class="flaticon-cursor"></i>
                                    {{ $partner->address ? $partner->address : 'Non spécifié' }}
                                </span>
                                <a href="{{ route('client.partner.show', ['partner_name' => $partner->name]) }}">
                                    <h3>{{ $partner->short_description }} </h3>
                                </a>
                                <p>{{ substr($partner->description, 0, 120) }}</p>
                                <div class="content-tag">
                                    <ul>
                                        <li>
                                            <a href="https://www.google.com/maps">
                                                <i class="flaticon-place"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-details.html">
                                                <i class="flaticon-like"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop.html">
                                                <i class="flaticon-workflow"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <h3 class="price"> <a href="#">À partir de: {{ $partner->min_amount }}
                                            XOF</a></h3>
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
                        <img src="assets/img/mobile.png" alt="Images">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="application-content">
                        <div class="section-title">
                            <span>Download app</span>
                            <h2>
                                Get More In Our Application
                                Sit Back And Enjoy
                            </h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eusmod tempor incididunt
                                ut
                                labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. </p>
                        </div>
                        <div class="application-btn d-flex justify-content-center">
                            <a href="{{ route('client.partner.index') }}" class="application-play-btn">
                                <div class="btn-content">
                                    <span>Commander un</span>
                                    <h3>Chèque Cadeau</h3>
                                </div>
                            </a>
                        </div>
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
                <span>Testimonials</span>
                <h2>What Our Clients Say</h2>
            </div>

            <div class="testimonial-slider owl-carousel owl-theme">
                <div class="testimonial-item testimonial-item-bg">
                    <h3>Sanaik Tubi</h3>
                    <span>Arbon Restaurant</span>
                    <p>Roinin ipsum dolor sit amet, consectetur adipisicing sit ut fugit, sed quia consequuntur magni
                        dolores eos qui ratione voluptatem sequi nesciunt.</p>
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
