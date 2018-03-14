@extends('layouts.front-end')

@section('openGraph')
    <meta property="og:url"                content="{{ config('app.url') }}" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{ config('app.name') }} - Evenementen" />
    <meta property="og:description"        content="Blijf op de hoogte omtrent de acties die wij ondernemen." />
    <meta property="og:image"              content="{{ asset('img/seo.png') }}" />
@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-3"><i class="fa fa-calendar icon-jumbotron"></i> Kalender,</h1>
            <p class="lead">
                Onze evenementen of evenementen waarin we participeren.
            </p>
        </div>
    </div>

    <div class="container">
        <div class="row">
        <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-body">

                @if (count($dates) > 0) 
                    @php (\Jenssegers\Date\Date::setLocale('nl'))

                    <div class="agenda">
                        <div class="table-responsive">
                            <table class="table table-sm table-condensed table-bordered">
                                <tbody>
                                    @foreach ($dates as $date)
                                        @php ($datum = new \Jenssegers\Date\Date($date->start_date))

                                        @if (count($date->events) == 1) {{-- Single event in a single day --}}
                                            <tr>
                                                <td class="agenda-date" class="active" rowspan="{{ count($date->events) }}">
                                                    <div class="dayofmonth day-color">{{ $datum->format('d') }}</div>
                                                    <div class="dayofweek">{{ $datum->format('l') }}</div>
                                                    <div class="shortdate text-muted">{{ $datum->format('F') }}, {{ $datum->year }}</div>
                                                </td>
                                                
                                                @foreach ($date->events as $event)
                                                    <td class="agenda-time">{{ $event->start_time }}u - {{ $event->end_time }}u </td>
                                                    <td class="agenda-events">
                                                        <div class="agenda-event">
                                                            {{ ucfirst($event->name) }}
                                                        </div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @else {{-- Multiple events in a single day (note the rowspan) --}}
                                            <tr>
                                                <td class="agenda-date" class="active" rowspan="{{ count($date->events) }}">
                                                    <div class="dayofmonth day-color">{{ $datum->format('d') }}</div>
                                                    <div class="dayofweek">{{ $datum->format('l') }}</div>
                                                    <div class="shortdate text-muted">{{ $datum->format('F') }}, {{ $datum->year }}</div>
                                                </td>

                                                @foreach ($date->events as $multiple)
                                                    @if ($loop->first)
                                                        <td class="agenda-time">{{ $multiple->start_time }}u - {{ $multiple->end_time }}u </td>
                                                        <td class="agenda-events">
                                                            <div class="agenda-event">
                                                                {{ ucfirst($multiple->name) }}
                                                            </div>
                                                        </td>

                                                        </tr>
                                                     @else
                                                        <tr>
                                                            <td class="agenda-time">{{ $multiple->start_time }}u - {{ $multiple->end_time }}u </td>
                                                        
                                                            <td class="agenda-events">
                                                                <div class="agenda-event">
                                                                    {{ ucfirst($multiple->name) }}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $dates->render('vendor.pagination.simple-bootstrap-4.blade.php') }} {{-- pagination instance --}}
                        </div>
                    </div>
                @else 
                    <div class="alert alert-info" role="alert">
                        <strong><i class="fa fa-info-circle"></i> Info:</strong> Activisme_be organiseerd or participeerd momenteel niet aan evenementen.
                    </div>
                @endif

            </div>
            </div>
            </div>
        </div>
    </div>
@endsection