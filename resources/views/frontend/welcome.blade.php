@extends('layouts.front-end')

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            {{-- Default value = display-3 but changed to 4 due responsive bug. --}}
            <h1 class="display-4">{{ config('app.name', 'Laravel') }},</h1>
            <p class="lead">
                Een klein collectief. Dat opkomt voor Daklozen, Vluchtelingen, Ook zetten wij in voor wereldvrede en andere sociale punten.
            </p>
            <hr class="my-4">
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="{{ route('visie.index') }}" role="button">
                    <i class="fa fa-info-circle"></i> Onze visie
                </a>

                <a class="btn btn-primary btn-lg" href="{{ route('ondersteuning.index') }}" role="button">
                    <i class="fa fa-heart text-danger"></i> Ondersteun ons
                </a>
            </p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8"> {{-- Content --}}
            
                @if (! is_null($article))
                    <div class="card mb-4 br-card card-shadow">
                        <a href="{{ route('news.show', ['slug' => $article->slug]) }}">
                            <img class="card-img-top" style="border-top-left-radius: 3px; border-top-right-radius: 3px;" height="250" src="{{ $article->getFirstMediaUrl('images', 'thumb-image') }}" alt="{{ ucfirst($article->title) }}">
                        </a>
                        
                        <div class="card-body">
                            <h2 class="card-title icon-jumbotron">{{ ucfirst($article->title) }}</h2>

                            <p class="card-text">
                                @if (strlen(strip_tags($article->message)) > 250)
                                    {!! str_limit(ucfirst($article->message), 255, '...') !!}
                                @else {{-- Lees meer knop is niet nodig. --}}
                                    {!! ucfirst($article->message) !!}
                                @endif
                            </p>
                        </div>
                        <div class="card-footer text-muted">
                            Geplaatst op {{ $article->publish_date->format('d F Y') }}
                            {{-- <span class="pull-right">{{ $article->author->name }}</span> --}}
                        </div>
                    </div>
                @endif

                @if (count($articles) > 0)
                    <hr> {{-- Needed breakline between sub messages and head message --}} 

                    <div class="card mb-4">
                        <div class="card-body">
                            <ul class="list-unstyled">
                                @foreach ($articles as $article)
                                    <li class="media @if (! $loop->last) mb-3 @endif">
                                        <a href="{{ route('news.show', ['slug' => $article->slug]) }}">
                                            <img style="border-radius: 3px; width: 100px; height: 100px;" class="mr-3" src="{{ $article->getFirstMediaUrl('images', 'thumb-100') }}" alt="{{ $article->title }}">
                                        </a>
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-1">{{ $article->title }}</h5>

                                            @if (strlen(strip_tags($article->message)) > 150)
                                                {!! str_limit(ucfirst($article->message), 157, '...') !!}
                                            @else {{-- Lees meer knop is niet nodig. --}}
                                                {!! ucfirst($article->message) !!}
                                            @endif

                                            <hr class="mt-1 mb-0">
                                            <small>Geplaatst op {{ $article->created_at->format('d F Y') }}.</small>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div> 
                @endif
            
            </div> {{-- /END content --}}
        
            <div class="col-lg-4"> {{-- Sidebar --}}
                <form action="{{ route('nieuwsbrief.inschrijven') }}" method="POST">
                    {{ csrf_field() }} {{-- Form field protection --}}

                    <div class="card mb-4">
                        <div class="card-header"><i class="fa fa-newspaper-o"></i> Nieuwsbrief</div>
                        <div class="card-body">
                            <div class="input-group">
                                <input type="text" name="email" class="form-control" placeholder="Email adres">
                                <span class="input-group-btn">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-send"></i>
                                </button>
                            </span>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="mb-4 card"> {{-- Categories --}}
                    <div class="card-header"><i class="fa fa-tags-o"></i> Nieuws categorieen</div>
                    <div class="card-body">
                        @if (count($tags) > 0) 
                            @foreach ($tags as $tag) {{-- Loop through the tags --}}
                                <a class="badge badge-danger" href="{{ route('categories', ['slug' => $tag->slug]) }}">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        @else {{-- Geen categorieen gevonden --}}
                            <i class="text-muted">(Er zijn momenteel geen categorieen.)</i>
                        @endif
                    </div>
                </div> {{-- /END categories --}}

            </div> {{-- /END sidebar --}}
        </div>
    </div>
@endsection