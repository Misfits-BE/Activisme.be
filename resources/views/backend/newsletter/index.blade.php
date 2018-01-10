@extends('layouts.front-end')

@section('content')
    <div class="container my-4">
        {{ Breadcrumbs::render('newsletter-index') }}
        @include('flash::message')
    </div>
@endsection