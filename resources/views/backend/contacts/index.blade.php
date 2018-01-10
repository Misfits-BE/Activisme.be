@extends('layouts.front-end')

@section('content')
    <div class="container my-4">
        {{ Breadcrumbs::render('contacts-index') }}

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-fw fa-address-book"></i> Contacten

                        <div class="pull-right">
                            <a href="" class="badge badge-link">
                                <i class="fa fa-search"></i> Zoek contact
                            </a>

                            <a href="{{ route('admin.contacts.create') }}" class="badge badge-link">
                                <i class="fa fa-plus"></i> Contact toevoegen
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Naam:</th>
                                    <th scope="col">Tel. nr:</th>
                                    <th scope="col">Organisatie:</th>
                                    <th scope="col" colspan="2">Toegevoegd op:</th> {{-- Colspan 2 is nodig voor de functies. --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($contacts) > 0) {{-- Contact personen gevonden in het systeem --}}
                                    @foreach ($contacts as $contact) {{-- Contact persons loop --}}
                                        <tr>
                                            <td><a href="mailto:{{ $contact->email }}">{{ $contact->naam }}</a></td>
                                            <td>{{ $contact->telefoon_nr }}</td>
                                            <td>{{ $contact->organisatie }}</td>
                                            <td>{{ $contact->created_at->format('d/m/Y') }}</td>

                                            <td class="text-center"> {{-- Beheers functies --}}
                                                {{-- TODO: Implement tooltips --}}

                                                <a href="" class="text-warning"> {{-- TODO: register edit routes --}}
                                                    <i class="fa fa-fw fa-pencil"></i>
                                                </a>

                                                <a href="{{ route('admin.contacts.delete', $contact) }}" class="text-danger">
                                                    <i class="fa fa-fw fa-close"></i>
                                                </a>
                                            </td> {{-- /// Beheers functies. --}}
                                        </tr>
                                    @endforeach {{-- /// Loop --}}
                                @else {{-- Geen contact personen gevonden in het systeem. --}}
                                    <tr>
                                        <td colspan="5"><i>(Er zijn geen contact personen gevonden.)</i></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        {{ $contacts->links('vendor.pagination.simple-bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection