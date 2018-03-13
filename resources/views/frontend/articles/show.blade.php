@extends('layouts.front-end')

@section('openGraph')
    <meta property="og:url"                content="{{ config('app.url') }}" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{ ucfirst($article->title) }}" />
    <meta property="og:description"        content="{{ str_limit(strip_tags(ucfirst($article->message))) }}" />
    <meta property="og:image"              content="{{ asset('img/seo.png') }}" />
@endsection

@section('content')
    <div class="container">
        @include('flash::message')
        
        <div class="row mt-4 mb-4">
            <div class="col-8"> {{-- Content --}}
                <div class="mb-4 card br-card card-shadow">
                    <img class="card-img-top" style="border-top-left-radius: 5px; border-top-right-radius: 5px;" height="250" src="{{ $article->getFirstMediaUrl('images', 'thumb-image') }}" alt="{{ $article->title }}">
                    <div class="card-img-overlay">
                        @if (auth()->check() && auth()->user()->hasRole('admin') && $article->is_published == 'N')
                            <h3 class="card-title text-right text-white">
                                <span class="badge badge-warning">Klad versie</span>
                            </h3>
                        @endif
                    </div>
                    <div class="card-body">
                        <h3 class="icon-jumbotron"> {{ ucfirst($article->title) }} </h3>
                        {!! ucfirst($article->message) !!}

                        @php(\Carbon\Carbon::setLocale(config('app.locale')))
                        <p class="mb-0 mt-3"><small class="text-left text-muted">({{ $article->created_at->diffForHumans() }} door: <strong>{{ $article->author->name}}</strong>)</small></p>
                    </div>
                </div>
            </div> {{-- /END content --}}

            <div class="col-4"> {{-- Social media --}}

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ $share['facebook'] }}" class="btn btn-block btn-social btn-facebook">
                                    <span class="fa fa-facebook-official text-white"></span>
                                    <center><span class="font-weight-bold text-white text-uppercase">deel</span></center>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ $share['twitter'] }}" class="btn btn-block btn-social btn-twitter">
                                    <span class="fa fa-twitter text-white"></span>
                                    <center><span class="font-weight-bold text-white text-uppercase">tweet</span></center>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="card"> {{-- Categories --}}
                    <div class="card-header">Nieuws categorieen</div>
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

            </div> {{-- /END social media --}}
        </div>
    </div>
@endsection