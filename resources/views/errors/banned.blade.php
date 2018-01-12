@extends('layouts.errors')

@section('403 Toegang geweigerd')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1><i class="fa fa-ban text-danger">@yield('title')</i></h1>
            <p class="lead">
                Sorry! U hebt geen toegang om deze pagin te bekijken op
                <em><span id="display-domain"></span></em>.
            </p>

            <p>
                <a onclick="javaascript:checkSite();" class="btn btn-default btn-lg-green">Ga terug naar de website.</a>
                <script type="text/javascript">
                    function checkSite() {
                        var currentSite = window.location.hostname; 
                        window.location = "http://" + currentSite;
                    }
                </script>
            </p>
        </div>
    </div>

    <div class="container">
        <div class="body-content">
            <div class="row">
                <div class="col-md-6">
                    <h2>Wat is er gebeurd?</h2>
                    <p class="lead">U hebt mogelijk niet de juisten rechten om de pagina in het systeem te bekijken. Of uw account is tijdelijk geblokkeerd door een administrator.</p>
                </div>
                <div class="col-md-6">
                    <h2>Wat kan ik doen?</h2>
                    <p class="lead">Indien u een bezoeker bent</p>
                    <p>U kunt de knop gebruiker om terug te gaan naar de website. En indien u dringend ondersteuning nodig hebt of vragen hebt. Kunt u ons altijd per mail bereieken. </p>
                    <p class="lead">Indien u een administrator bent.</p>
                    <p>Kijk na of u op de juiste plaats bent. Indien u denkt dat het om een fout gaat voel u vrij om contact op te nemen met de ontwikkelaar(s) v/d website.</p>
                </div>
            </div>
        </div>
    </div>
@endsection