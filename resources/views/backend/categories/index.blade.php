@extends('layouts.front-end')

@section('content')
    <div class="container my-4">
        {{ Breadcrumbs::render('categories-index') }} {{-- Breadcrumb view instance --}}
        @include('flash::message')                    {{-- Flash session view instance --}}

        <div class="row">
            <div class="col-md-12">
            
                <div class="card card-shadow">
                    <div class="card-header">
                        <i class="fa fa-fw fa-tags"></i> Nieuws bericht (categorieen)

                        <span class="pull-right">
                            <a href="{{ route('admin.categories.create') }}" class="badge badge-link">
                                <i class="fa fa-plus"></i> Categorie toevoegen
                            </a>
                        </span>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm table-hover"> {{-- Category table --}}
                            <thead>
                                <th>#</th>
                                <th>Ingevoegd door:</th>
                                <th>Naam:</th>
                                <th colspan="2">Beschrijving:</th> {{-- Colspan="2" nodig voor de functies. --}}
                            </thead>
                            <tbody>
                                @if (count($categories) > 0) {{-- Er zijn categorieen in het systeem --}}
                                    @foreach ($categories as $category) {{-- Category loop --}}
                                        <tr>
                                            <td><strong>#{{ $category->id }}</strong></td>
                                            <td>{!! $category->author->name !!}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->description }}</td>

                                            <td> {{-- Opties --}}
                                                <span class="pull-right">
                                                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-muted">
                                                        <i class="fa fa-fw fa-pencil"></i>
                                                    </a>
                                                
                                                    <a href="{{ route('admin.categories.delete', $category) }}" class="text-danger">
                                                        <i class="fa fa-fw fa-close"></i>
                                                    </a>
                                                </span>
                                            </td> {{-- /// Opties --}}
                                        </tr>
                                    @endforeach {{-- /// Category loop --}}
                                @else {{-- Er zijn geen categorieen in het systeem --}}
                                    <tr>
                                        <td colspan="5"><i>(Er zijn geen categorieen gevonden in het systeem)</i></td>
                                    </td>
                                @endif
                            </tbody>
                        </table> {{-- /// Category table --}}
                    </div> {{-- /// Card body --}}

                    {{-- // TODO: Paginatie --}}
                </div>{{-- /// Card --}}
            
            </div> {{-- /// Col 12 --}}
        </div> {{-- /// Row --}}
    </div> {{-- /// Container --}}
@endsection