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
                            {{-- TODO: Check for better tekst.  --}}
                            Bedankt alvast voor je intresse, hieronder vind je het formulier om je gift te vervolledigen. Uw gift zal gebruikt
                            om de organisatie verder uit te bouwen, mensen in armoede helpen, enz...
                        </p>

                        <p>Wij bieden momenteel aleen maar de mogelijkheid om met bancontact te betalen.</p>

                        <hr>

                        <form action="{{ route('gift.save') }}" method="POST"> {{-- Payment form  --}}
                            {{ csrf_field() }} {{-- CSRF form field protection --}}

                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <select class="form-control" name="plan">
                                        <option value="7.00"  @if (old('plan') == '7.00'  || $plan == '7.00')  selected @endif> BRONS (7€) </option>
                                        <option value="12.00" @if (old('plan') == '12.00' || $plan == '12.00') selected @endif> ZILVER (12€) </option>
                                        <option value="17.00" @if (old('plan') == '17.00' || $plan == '17.00') selected @endif> GOUD (17€) </option>
                                        <option value="22.00" @if (old('plan') == '22.00' || $plan == '22.00') selected @endif> DIAMANT (€22) </option>
                                    </select>

                                    @if ($errors->has('plan'))
                                        {{ dd($errors->all()) }}
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('plan') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Uw voornaam" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}">

                                    @if ($errors->has('firstname'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-lg-6">
                                    <input type="text" placeholder="Uw achternaam" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}">

                                    @if ($errors->has('lastname'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="text" placeholder="Uw E-mail adres" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-9">
                                    <input type="text" placeholder="Uw straatnaam" class="form-control{{ $errors->has('street_name') ? ' is-invalid' : ''}}" name="street_name" value="{{ old('street_name') }}">

                                    @if ($errors->has('street_name'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('street_name') }}</strong>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-lg-3">
                                    <input type="text" placeholder="Huis nr." class="form-control{{ $errors->has('huis_nr') ? ' is-invalid' : '' }}" name="huis_nr" value="{{ old('huis_nr') }}">

                                    @if ($errors->has('huis_nr'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('huis_nr') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <input type="text" placeholder="Postcode" class="form-control{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" name="postal_code" value="{{ old('postal_code') }}">

                                    @if ($errors->has('postal_code'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('postal_code') }}</strong>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-lg-9">
                                    <input type="text" placeholder="Uw gemeente" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}">

                                    @if ($errors->has('city'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-md btn-success">
                                        <i class="fa fa-heart"></i> Steun
                                    </button>

                                    <a href="{{ route('ondersteuning.index') }}" class="btn btn-md btn-danger">
                                        <i class="fa fa-undo"></i> Annuleren
                                    </a>
                                </div>
                            </div>
                        </form> {{-- /Payment form  --}}

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
            </div>
        </div>
    </div>
@endsection