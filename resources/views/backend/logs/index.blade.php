@extends('layouts.front-end')

@section('content')
    <div class="container my-4">
        {{ Breadcrumbs::render('logs-index') }}

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-fw fa-list"></i> Applicatie logs

                        <span class="pull-right">
                            <a href="#" class="badge badge-link" data-toggle="modal" data-target="#searchModal">
                                <i class="fa fa-search"></i> Zoek activiteit
                            </a>
                        </span>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Gebruiker:</th>
                                    <th scope="col">Activiteit:</th>
                                    <th scope="col">Tijdstip:</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($logs) > 0)
                                    @foreach ($logs as $log)
                                        <tr>
                                            <td><a href="mailto:{{ $log->causer->email }}">{{ $log->causer->name }}</a></td>
                                            <td>{{ $log->description }}</td>
                                            <td>
                                                @php (\Carbon\Carbon::setLocale(config('app.locale')))
                                                {{ $log->created_at->diffForHumans() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3"><i>(Er is nog geen activiteit in het systeem.)</i></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        {{ $logs->render('vendor.pagination.simple-bootstrap-4') }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('backend.logs.search') {{-- Search model --}}
@endsection