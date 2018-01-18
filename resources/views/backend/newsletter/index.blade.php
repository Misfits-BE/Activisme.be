@extends('layouts.front-end')

@section('content')
    <div class="container my-4">
        {{ Breadcrumbs::render('newsletter-index') }}
        @include('flash::message')

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> {{-- card header --}}
                        <i class="fa fa-fw fa-newspaper-o"></i> Nieuwsbrieven

                        <span class="pull-right">
                            @if (count($letters) >= 10) {{-- Meer dan 10 brieven dus zoekfunctie beschikbaar --}}
                                <a href="" class="badge badge-link">
                                    <i class="fa fa-search"></i> Zoek nieuwsbriefgit
                                 </a>
                            @endif

                            <a href="{{ route('admin.nieuwsbrief.create') }}" class="badge badge-link">
                                <i class="fa fa-plus"></i> Nieuwsbrief toevoegen.
                            </a>
                        </span>
                    </div> {{-- /// Card header --}}

                    <div class="card-body"> {{-- Card body --}}
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Status:</th>
                                    <th scope="col">Autheur:</th>
                                    <th scope="col">Titel:</th>
                                    <th colspan="2" scope="col">Verzonden op:</th> {{-- colspan="2" = options --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($letters) == 0) {{-- Geen nieuwsbrieven gevonden in het systeem. --}}
                                    <tr>
                                        <td colspan="6"><i>(Er zijn geen nieuwsbrieven gevonden,)</i></td>
                                    </tr>
                                @else {{-- Nieuwsbrieven gevonden in het systeem.  --}}
                                    @foreach ($letters as $letter) {{-- Loop voor de nieuwsbrieven --}}
                                        <tr>
                                            <td><code>#NB{{ $letter->id }}</code></td>
                                            <td>{{ $letter->status }}</td>
                                            <td>{{ $letter->author->name }}</td>
                                            <td>{{ $letter->titel  }}</td>
                                            <td>00/00/00</td>

                                            <td class="pull-right"> {{-- Opties --}}
                                                @if (! $letter->is_send)
                                                    <a href="" class="text-warning">
                                                        <i class="fa fa-fw fa-envelope"></i>
                                                    </a>
                                                @endif

                                                <a href="" class="text-danger">
                                                    <i class="fa fa-fw fa-close"></i>
                                                </a>
                                            </td> {{-- /Opties --}}
                                        </tr>
                                    @endforeach {{-- /// end loop --}}
                                @endif
                            </tbody>
                        </table>

                        {{ $letters->render('vendor.pagination.simple-bootstrap-4') }}
                    </div> {{-- /// Card body --}}
                </div>
            </div>
        </div>
    </div>
@endsection