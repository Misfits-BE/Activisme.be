@extends('layouts.front-end')

@section('content')
    <div class="container my-4">
        {{ Breadcrumbs::render('calendar-index') }}

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-fw fa-calendar"></i> Kalender

                        <span class="pull-right">
                            <a href="" class="badge badge-link">
                                <i class="fa fa-search"></i> Evenement zoeken
                            </a>

                            <a href="{{ route('admin.calendar.create') }}" class="badge badge-link">
                                <i class="fa fa-plus"></i> Evenement toevoegen
                            </a>
                        </span>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ingevoegd door:</th>
                                    <th>Status:</th>
                                    <th>Datum:</th>
                                    <th>Uren:</th>
                                    <th colspan="2">Evenement:</th> {{-- colspan="2" nodig voor de functies --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($events) > 0)
                                    @foreach ($events as $event)
                                        <tr>
                                            <td><strong>#{{ $event->id }}</strong></td>
                                            <td>{{ $event->author->name }}</td>

                                            <td> {{-- Status indicator --}}
                                                 @if ($event->status == 'public')
                                                    <span class="badge badge-success">Gepubliceerd</span>
                                                 @elseif ($event->status == 'draft')
                                                    <span class="badge badge-warning">Klad versie</span>
                                                 @endif 
                                            </td> {{-- /Status indicator --}}

                                            <td> @foreach ($event->dates as $date) {{ $date->start_date->format('d/m/Y') }} @endforeach </td>
                                            <td> {{ $event->start_time }}u - {{ $event->end_time }}u</td>
                                            <td> {{ $event->name }}</td>

                                            <td class="pull-right"> {{-- Opties --}}
                                                <a href="" class="text-muted" data-toggle="tooltip" data-placement="bottom" title="Wijzig evenement">
                                                    <i class="fa fa-fw fa-pencil"></i>
                                                </a>

                                                @if ($event->status == 'public') 
                                                    <a href="" class="text-warning" data-toggle="tooltip" data-placement="bottom" title="Zet naar klad">
                                                        <i class="fa fa-fw fa-undo"></i>
                                                    </a> 
                                                @elseIf($event->status == 'draft')
                                                    <a href="" class="text-success" data-toggle="tooltip" data-placement="bottom" title="Publiceer">
                                                        <i class="fa fa-fw fa-check"></i>
                                                    </a> 
                                                @endif

                                                <a href="" class="text-danger" data-toggle="tooltip" data-placement="bottom" title="Verwijder">
                                                    <i class="fa fa-fw fa-close"></i>
                                                </a>
                                            </td> {{-- /Opties --}}
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6"><i>(Er zijn geen evenementen in het systeem.)</i></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        {{ $events->links('vendor.pagination.simple-bootstrap-4') }} {{-- Pagination instance --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection