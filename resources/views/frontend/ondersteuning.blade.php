@extends('layouts.front-end')

@section('open-graph')
    <meta property="og:url"                content="{{ config('app.url') }}" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{ config('app.name') }} - Ondersteun ons" />
    <meta property="og:description"        content="Bedankt alvast voor je intresse, hieronder vind je het formulier om je gift te vervolledigen. Uw gift zal gebruikt
                                                    om de organisatie verder uit te bouwen, mensen in armoede helpen, enz..." />
    <meta property="og:image"              content="{{ asset('img/seo.png') }}" />
@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-3"><i class="icon-jumbotron fa fa-heart"></i> Ondersteun Activisme_BE,</h1>
            <p class="lead">
                Ons klein collectief. Draait volledig op vrije giften, eigen inbreng en vrijwilligers.
            </p>
        </div>
    </div>

    <div class="container">
        @include('flash::message')
        
        <div class="row">
            <div class="col-8"> {{-- Content --}}
                <div class="mb-4 card br-card card-shadow">
                    <img class="card-img-top" style="border-top-left-radius: 5px; border-top-right-radius: 5px;" height="200" src="{{ asset('img/banner.jpg') }}" alt="Card image cap">
                    <div class="card-img-overlay">
                        <h3 class="card-title  text-right text-white">
                            Ondersteun de werking van Activisme_BE
                        </h3>
                    </div>
                    <div class="card-body">
                        {{-- <h3>Ondersteun de werking van Activisme_BE</h3> --}}

                        <p>
                            Met ons klein team dat opkomt voor wereldvrede en de rechten van de mens, gebruiken
                            we deze website, activisme.be. als uitvalsbasis. Activisme.be wil een platform bieden om mensen en organisaties
                            samen te brengen en vauit een verenigd front te strijden voor onze belangen die nu naar ons gevoel
                            maar al te vaak op de helling worden gezet. Naast zichtbare aanwezigheid op tal van demonstraties,
                            parades en betogingen, enz... organiseren wij zelf ook straatacties en ludieke (protest)acties. De website activisme.be
                            is de plaats bij uitstek waar we ruchtbaarheid kunnen geven aan deze acties, betogingen en demonstraties.
                        </p>

                        <p>
                            Daarnaast leggen we via activisme.be online petities en petitielijsten aan, die wijds kunnen uitgestuurd worden naar
                            onze achterban. Andere organisaties en bewegingen kunnen gratis gebruik maken van dit platform om petities voor de
                            goede zaak op te stellen en te verspreiden.
                        </p>

                        <p>
                            Om dit alles draaiende te houden, de website up to date te houden, de petities op te stellen en de deur uit te krijgen,
                            hebben we jullie hulp nodig. Aangezien we zonder enige subsidie of overheidssteun werken, is elke gift,
                            hoe klein ook, welkom. Deze giften zullen integraal gebruikt worden om ons webteam te ondersteunen,
                            zodat activisme.be langzaam aan kan uitgroeien tot een platform dat gebruikt kan worden om het beleid,
                            de politici en iedereen die meewerkt aan een samenleving waar steeds meer mensen naar de marge worden verwezen,
                            op het matje en tot verantwoording te roepen.
                        </p>

                        <h3>De vredes caravan</h3>

                        <p>
                            Recent hebben we ook een oude caravan aangekocht, die gebruikt zal worden om verscheidene acties mee te voeren.
                            Zoals kledij, soep en voedig te gaan bedelen over het hele land aan minderbedeelden en daklozen. Daarom dat we
                            de caravan voor verschillende doeleinden zullen gebruiken. Zal het interieur ook volledig moeten aangepast worden,
                            zodat deze uit mobiele eenheden zal bestaan, die gemakkelijk te verplaatsen zijn, volgens het doel dat we uitvoeren.
                            Aangezien we zonder enige subsidie of overheidssteun werken, is elke gift welkom. Het rekeningnummer om ons
                            vrijblijvend te steunen vind u hieronder.
                        </p>

                        @if (env('MOLLIE_ACITVE', 'false'))
                            <h3>Het rekeningnummer om ons vrijblijvend te steunen: </h3>

                            <p>                            
                                Belfius<br> 
                                IBAN: BE61 0689 0830 7017<br> 
                                BIC: GKCC BE BB<br> 
                                Met vermelding: Ik steun activisme.be of Ik steun de vredescaravan<br>
                            </p>
                        @endif
                    </div>
                </div>
            </div> {{-- /END content --}}

            <div class="col-4"> {{-- Social media --}}
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row font-weight-bold">
                            <div class="col-md-6">
                                <h4 class="font-weight-bold">{{ $backers }}</h4>
                                <span class="text-muted">Bijdrages</span>
                            </div>

                            <div class="col-md-6">
                                <h4 class="font-weight-bold">{{ $collected }}€</h4>
                                <span class="text-muted">Ingezameld</span>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ $social['facebook'] }}" class="btn btn-block btn-social btn-facebook">
                                    <span class="fa fa-facebook-official text-white"></span>
                                    <center><span class="font-weight-bold text-white text-uppercase">deel</span></center>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ $social['twitter'] }}" class="btn btn-block btn-social btn-twitter">
                                    <span class="fa fa-twitter text-white"></span>
                                    <center><span class="font-weight-bold text-white text-uppercase">tweet</span></center>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @if (env('MOLLIE_ACTIVE', false))
                    <div class="card">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('ondersteuning.create', ['plan' => 'brons']) }}" class="list-group-item list-group-item-action">
                                <h4 class="mb-0 font-weight-bold"><i class="fa fa-fw fa-shield plan-bronze"></i> Brons</h4>
                                <small>- Een gift van 7 euro.</small>
                            </a>

                            <a href="{{ route('ondersteuning.create', ['plan' => 'zilver']) }}" class="list-group-item list-group-item-action">
                                <h4 class="mb-0 font-weight-bold"><i class="fa fa-fw fa-shield plan-silver"></i> Zilver</h4>
                                <small>- Een gift van 12 euro.</small>
                            </a>

                            <a href="{{ route('ondersteuning.create', ['plan' => 'goud']) }}" class="list-group-item list-group-item-action">
                                <h4 class="mb-0 font-weight-bold"><i class="fa fa-fw fa-shield plan-gold"></i> Goud</h4>
                                <small>- Een gift van 17 euro.</small>
                            </a>

                            <a href="{{ route('ondersteuning.create', ['plan' => 'diamant']) }}" class="list-group-item list-group-item-action">
                                <h4 class="mb-0 font-weight-bold">
                                    <i class="fa fa-fw fa-shield plan-diamond"></i> Diamant
                                </h4>
                                <small>- Een gift van 22 euro.</small>
                            </a>
                        </div>
                    </div> 
                @endif
            </div> {{-- /END social media --}}
        </div>
    </div>
@endsection