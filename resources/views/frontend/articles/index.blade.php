@extends('layouts.front-end')

@section('openGraph')
    <meta property="og:url"                content="{{ config('app.url') }}" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{ config('app.name') }} - Nieuws" />
    <meta property="og:description"        content="Blijf op de hoogte omtrent de acties die wij ondernemen." />
    <meta property="og:image"              content="{{ asset('img/seo.png') }}" />     
@endsection

@section('twitter-card')

@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-3"><i class="icon-jumbotron fa fa-newspaper-o"></i> Nieuws,</h1>
            <p class="lead">
                Blijf op de hoogte omtrent de acites die wij ondernemen.
            </p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <ul class="list-unstyled mb-4">
                            @foreach ($articles as $article)
                                <li class="media @if (! $loop->last) mb-3 @endif">
                                    <a href="{{ route('news.show', ['slug' => $article->slug]) }}">
                                        <img class="mr-3" src="{{ $article->getFirstMediaUrl('images', 'thumb-100') }}" alt="{{ $article->title }}" style="border-radius: 3px; width: 100px; height: 100px;">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1 icon-jumbotron">{{ $article->title }}</h5>

                                        @if (strlen(strip_tags($article->message)) > 150)
                                            {!! strip_tags(str_limit(ucfirst($article->message), 157, '...')) !!}
                                        @else {{-- Lees meer knop is niet nodig. --}}
                                            {!! ucfirst($article->message) !!}
                                        @endif

                                        <hr class="mt-1 mb-0">
                                        <small>Geplaatst op {{ $article->created_at->format('d F Y') }}.</small>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        {{ $articles->render('vendor.pagination.simple-bootstrap-4') }}
                    </div>
                </div>
            </div>

            <div class="col-lg-4"> {{-- Sidebar --}}

                <div class="card"> {{-- Categories --}}
                    <div class="card-header">Nieuws categorieen</div>
                    <div class="card-body">
                        @if (count($tags) > 0) 
                            @foreach ($tags as $tag) {{-- Loop through the tags --}}
                                <a class="badge badge-danger" href="">
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