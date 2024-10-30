@extends('client_site.layouts.main')

@section('content')
    <section class="banner banner3 bg-full overlay"
        style="background-image: url({{ asset('assets/backoffice/img/photos/unsplash-1.jpg') }});">
        <div class="holder">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>Recherche : {{ $keyword }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="offer-sec container pad-top-lg pad-bottom-md">
        <div class="row">
            <div class="col-xs-12">
                <!-- offer holder of the page -->
                <div class="offer-holder" style="position: relative; height: 1173px;">
                    @foreach ($partners as $partner)
                        <div class="col {{ $partner->category->name }} mar-bottom-xs">
                            <div class="header">
                                <div class="c-logo"><img src="{{ Storage::disk('public')->url($partner->picture_1) }}"
                                        alt="{{ $partner->name }} Logo" style="height:90px; width:auto">
                                </div>
                            </div>
                            <strong class="heading6">{{ $partner->name }}</strong>
                            <span class="sub-title">{{ $partner->description }}</span>
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
        <div class="row">
            <div class="col-xs-12">
                <!-- pagination of the page -->
                {{ $partners->links() }}
            </div>
        </div>
    </section>
@endsection
