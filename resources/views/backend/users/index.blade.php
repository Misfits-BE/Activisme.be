@extends('layouts.front-end')

@section('content')
    <div class="container my-4">
        {{ Breadcrumbs::render('users-index') }}
        @include('flash::message')

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-fw fa-users"></i> Gebruikersbeheer

                        <span class="pull-right">
                            @if (count($users) > 10)
                                <a href="" class="badge badge-link">
                                    <i class="fa fa-search"></i> Gebruiker zoeken
                                </a>
                            @endif

                            <a href="{{ route('admin.users.create') }}" class="badge badge-link">
                                <i class="fa fa-user-plus"></i> Gebruiker toevoegen
                            </a>
                        </span>
                    </div>

                    <div class="card-body">

                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Status:</th>
                                    <th scope="col">Gebruikersnaam:</th>
                                    <th scope="col">Email:</th>
                                    <th colspan="2" scope="col">Geregistreerd op:</th> {{-- colspan="2" = options --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($users) > 0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td><strong>#{{ $user->id }}</strong></td>
                                            <td>
                                                @if ($user->isBanned())
                                                    <span class="badge badge-danger">Geblokkeerd</span>
                                                @endif  

                                                @if ($user->isOnline())
                                                    <span class="badge badge-success">Online</span>
                                                @else
                                                    <span class="badge badge-danger">Offline</span>
                                                @endif
                                            </td>

                                            <td>{{ $user->name }}</td>
                                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                            <td>
                                                @php (\Carbon\Carbon::setLocale(config('app.locale')))
                                                {{ $user->created_at->diffForHumans() }}
                                            </td>

                                            <td class="text-right"> {{-- Options --}}
                                                @can ('auth-user', $user) {{-- Check of de gebruiker niet de zelfde is dan de aangemelde gebruiker --}}
                                                    @if ($user->isBanned()) {{-- De gebruiker is geblokkeerd in het systeem. --}}
                                                        <a class="text-success" href="">
                                                            <i class="fa fa-unlock"></i>
                                                        </a> 
                                                    @else {{-- Gebruiker is actief in het systeem. --}}
                                                        <a class="text-warning" href="{{ route('admin.users.lock', $user) }}">
                                                            <i class="fa fa-fw fa-lock"></i>
                                                        </a>
                                                    @endif 
                                                @endcan

                                                <a href="{{ route('admin.users.delete', $user) }}" class="text-danger">
                                                    <i class="fa fa-fw fa-close"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">(Er zijn geen gebruikers gevonden in het systeem.)</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        {{ $users->render('vendor.pagination.simple-bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection