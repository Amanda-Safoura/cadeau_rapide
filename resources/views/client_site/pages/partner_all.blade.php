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
                        <h2>Search Over 5000+ Coupons & Deals</h2>
                        <span class="txt">More than 3000 Stores in One Place</span>
                        <form action="{{ route('client.partner.search') }}" method="POST" class="search-form md-round">
                            @csrf
                            <fieldset>
                                <input name="search" type="search" class="form-control" placeholder="Mot-Clé . . .">
                                <button type="submit" class="sub-btn text-uppercase">search</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="twocolumns pad-top-lg pad-bottom-lg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <!-- Content of the page -->
                    <article id="content">
                        <!-- header of the page -->
                        <header class="header">
                            <h3 class="heading2">Liste des partenaires</h3>
                            <ul class="list-unstyled abc-list">
                                @foreach ($groupedPartners as $letter => $partnersStartWithLetter)
                                    <li><a
                                            href="{{ route('client.partner.letter', ['letter' => $letter]) }}">{{ $letter }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </header>
                        <!-- holder of the page -->
                        @foreach ($groupedPartners as $letter => $partnersStartWithLetter)
                            <div class="holder">
                                <div class="header-holder">
                                    <span class="txt pull-left text-uppercase">{{ $letter }}</span>
                                    <a href="{{ route('client.partner.letter', ['letter' => $letter]) }}"
                                        class="store-txt pull-right">{{ $partnersStartWithLetter->count() }}
                                        partenaire(s)</a>
                                </div>
                                <ul class="list-unstyled store-logo">
                                    @foreach ($partnersStartWithLetter as $partner)
                                        <li>
                                            <a
                                                href="{{ route('client.partner.show', ['partner_name' => $partner->name]) }}"><img
                                                    src="{{ Storage::disk('public')->url($partner->picture_1) }}"
                                                    alt="{{ $partner->name }}" class="img-responsive">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                        <!-- pagination of the page -->
                        {{ $partners->links() }}
                    </article>
                    <!-- Sidebar of the page -->
                    <aside id="sidebar">
                        <!-- Widget of the page -->
                        <section class="widget coupon-submit-widget overlay bg-full text-center"
                            style="background-image: url({{ asset('assets/backoffice/img/photos/unsplash-3.jpg') }});">
                            <span class="icon"><i class="icon-speaker"></i></span>
                            <strong class="title text-uppercase">Submit Your Coupon</strong>
                            <a href="#" class="btn-primary text-center text-uppercase">Submit now</a>
                        </section>
                        <!-- Widget of the page -->
                        <section class="widget category-widget">
                            <h3 class="heading4">Blog Categories</h3>
                            <ul class="list-unstyled category-list">
                                <li><a href="{{ route('client.partner.index') }}"><span class="pull-left">Toutes les
                                            Catégories</span><span class="pull-right">({{ $partners->count() }})</span></a>
                                </li>
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('client.partner.category', ['name' => $category->name]) }}"><span
                                                class="pull-left">{{ $category->name }}</span><span
                                                class="pull-right">({{ $category->partners->count() }})</span></a></li>
                                @endforeach
                            </ul>
                        </section>
                        <!-- Widget of the page -->
                        <section class="widget popular-widget">
                            <h3 class="heading4">Meilleurs Partenaires</h3>
                            <ul class="list-unstyled popular-list">
                                @foreach ($topPartners as $partner)
                                    <li>
                                        <a href="{{ route('client.partner.show', ['partner_name' => $partner->name]) }}"><img
                                                src="{{ Storage::disk('public')->url($partner->picture_1) }}"
                                                style="max-height: 70px;" alt="{{ $partner->name }}">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection
