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
                                            <td>
                                                @if ($letter->is_send) {{-- Nieuwsbrief is verzonden --}}
                                                    <span class="badge badge-info">Verzonden</span> 
                                                @else 
                                                    @if ($letter->status == 'publicatie')
                                                        <span class="badge badge-success">{{ $letter->status }}</span>  
                                                    @else {{-- Nieuwsbrief status == klad versie --}}
                                                        <span class="badge badge-warning"> {{ $letter->status }} </span>
                                                    @endif 
                                                @endif
                                            </td>
                                            <td>{{ $letter->author->name }}</td>
                                            <td>{{ $letter->titel  }}</td>
                                            <td>
                                                @if (is_null($letter->send_at))
                                                    <code>N.V.T</code>
                                                @else
                                                    {{ $letter->send_at->format('d/m/Y') }}
                                                @endif
                                            </td>

                                            <td> {{-- Opties --}}
                                                <span class="pull-right">
                                                    <a href="{{ route('admin.nieuwsbrief.show', ['slug' => $letter->slug]) }}" target="_blank" class="text-muted" data-toggle="tooltip" data-placement="bottom" title="Bekijk voorbeeld">
                                                        <i class="fa fa-fw fa-file-text-o"></i>
                                                    </a>

                                                    @if (! $letter->is_send)
                                                        <a href="{{ route('admin.nieuwsbrief.edit', ['slug' => $letter->slug]) }}" class="text-muted" data-toggle="tooltip" data-placement="bottom" title="Wijzig nieuwsbrief">
                                                            <i class="fa fa-fw fa-pencil"></i>
                                                        </a>

                                                        <a href="{{ route('admin.nieuwsbrief.zend', ['slug' => $letter->slug]) }}" class="text-warning" data-toggle="tooltip" data-placement="bottom" title="Verzend nieuwsbrief">
                                                            <i class="fa fa-fw fa-envelope"></i>
                                                        </a>
                                                    @endif

                                                    <a href="{{ route('admin.nieuwsbrief.destroy', ['slug' => $letter->slug]) }}" class="text-danger" data-toggle="tooltip" data-placement="bottom" title="Verwijder nieuwsbrief">
                                                        <i class="fa fa-fw fa-close"></i>
                                                    </a>
                                                </span>
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