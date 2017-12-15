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
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6"><i>(Er zijn geen evenementen in het systeem.)</i></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection