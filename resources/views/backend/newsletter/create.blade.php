@extends('layouts.front-end')

@section('content')
    <div class="container my-4">
        {{ Breadcrumbs::register('newsletter-create') }}
        @include('flash::message')
    </div>
@endsection