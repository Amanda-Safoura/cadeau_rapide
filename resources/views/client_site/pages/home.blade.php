@extends('client_site.layouts.main')

@section('title', 'Home')

@section('content')
    <!-- banner of the page -->
    <section class="banner banner2 bg-full overlay"
        style="background-image: url({{ asset('assets/backoffice/img/photos/unsplash-2.jpg') }});">
        <div class="holder">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <a href="{{ route('client.partner.index') }}" class="btn-primary text-center text-uppercase md-round"
                            style="padding: 45px 90px; font-size: 1.7em !important">Nos
                            partenaires</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- counter sec of the page -->
    <section class="counter-sec bg-ful overlay pad-top-sm pad-bottom-xs"
        style="background-image: url({{ asset('assets/client_side/images/img24.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-3 text-center mar-bottom-xs">
                    <span class="icon"><i class="icon-user2"></i></span>
                    <strong class="counter">300</strong>
                    <span class="sub-title">Users Registered</span>
                </div>
                <div class="col-xs-12 col-sm-3 text-center mar-bottom-xs">
                    <span class="icon"><i class="icon-scissors"></i></span>
                    <strong class="counter">2900</strong>
                    <span class="sub-title">Coupons Used Last Month</span>
                </div>
                <div class="col-xs-12 col-sm-3 text-center mar-bottom-xs">
                    <span class="icon"><i class="icon-add"></i></span>
                    <strong class="counter">150</strong>
                    <span class="sub-title">Coupons Added</span>
                </div>
                <div class="col-xs-12 col-sm-3 text-center mar-bottom-xs">
                    <span class="icon"><i class="icon-store"></i></span>
                    <strong class="counter">3500</strong>
                    <span class="sub-title">Stores In Coupay</span>
                </div>
            </div>
        </div>
    </section>
    <!-- store sec of the page -->
    <section class="store-sec style2 bg-grey pad-top-lg pad-bottom-lg">
        <div class="container">
            <div class="row">
                <header class="col-xs-12 text-center header">
                    <h3 class="heading">More Than <span class="clr">3000+ Stores</span> In One Place!</h3>
                    <p>Search your favourite store &amp; get many deals</p>
                </header>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <ul class="list-unstyled store-logo">
                        @foreach ($topPartners as $partner)
                            <li>
                                <a href="{{ route('client.partner.show', ['partner_name' => $partner->name]) }}">
                                    <img src="{{ Storage::disk('public')->url($partner->picture_1) }}"
                                        alt="{{ $partner->name }}" style="height: 90px; width:fit-content">
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="text-center">
                        <a href="#all_partners" class="btn-primary text-center text-uppercase md-round">Voir tous nos
                            partenaires</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- offer sec of the page -->
    <section id="all_partners" class="offer-sec style2 container pad-top-lg pad-bottom-md">
        <div class="row">
            <header class="col-xs-12 text-center header">
                <h2 class="heading">Parcourez dès maintenant, les offres de nos partenaires</h2>
                <ul class="list-unstyled filter-list">
                    @foreach ($categories as $key => $category)
                        <li @class(['active' => $key == 0])><a href="#"
                                data-filter=".{{ 'category' . $category->id }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </header>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="offer-holder">
                    @foreach ($partners as $partner)
                        <div class="col {{ 'category' . $partner->category->id }} mar-bottom-xs">
                            <div class="header">
                                <div class="c-logo"><img src="{{ Storage::disk('public')->url($partner->picture_1) }}"
                                        alt="{{ $partner->name }} Logo" style="height:90px; width:auto">
                                </div>
                            </div>
                            <strong class="heading6">{{ $partner->name }}</strong>
                            <span class="sub-title">{{ substr($partner->description, 0, 120) }}...</span>
                            <div class="text-center">
                                @auth
                                    <a href="{{ route('client.partner.ordering_page', ['partner_name' => $partner->name]) }}"
                                        class="btn-primary text-center text-uppercase md-round">commander un
                                        chèque
                                        cadeau</a>
                                @endauth
                                @guest
                                    <a href="{{ route('client.partner.show', ['partner_name' => $partner->name]) }}"
                                        class="btn-primary text-center text-uppercase md-round">commander un
                                        chèque
                                        cadeau</a>
                                @endguest
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
