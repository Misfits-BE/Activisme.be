@extends('layouts.front-end')

@section('content')
    <div class="container my-4">
        {{ Breadcrumbs::render('contacts-create') }}

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 br-card card-shadow">
                    <div class="card-header">
                        <i class="fa fa-fw fa-plus"></i> Contact toevoegen
                    </div>

                    <div class="card-body">
                        <form id="new-contact" action="{{ route('admin.contacts.store') }}" method="POST">
                            {{ csrf_field() }} {{-- Form protection --}}

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Naam: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <input type="text" placeholder="Naam van de contact persoon" class="form-control{{ $errors->has('naam') ? ' is-invalid' : '' }}" name="naam" value="{{ old('naam') }}">

                                    @if ($errors->has('naam'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('naam') }}</strong>
                                        </div>
                                    @endif 
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">E-mail adres: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <input type="email" placeholder="Het E-mail adres van de contact persoon" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Telefoon nr: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <input type="text" placeholder="Het telefoon nr van de contact persoon" class="form-control{{ $errors->has('telefoon_nr') ? ' is-invalid' : '' }}" name="telefoon_nr" value="{{ old('telefoon_nr') }}">
                                
                                    @if ($errors->has('telefoon_nr'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('telefoon_nr') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Organisatie: <span class="text-danger">*</span></label>
                            
                                <div class="col-lg-10">
                                    <input type="text" placeholder="De organisatie groep van de contact persoon" class="form-control{{ $errors->has('organisatie') ? ' is-invalid' : '' }}" name="organisatie" value="{{ old('organisatie') }}">

                                    @if ($errors->has('organisatie'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('organisatie') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="card-footer">
                        <div class="pull-right">
                            <button type="submit" form="new-contact" class="btn btn-sm btn-success">
                                <i class="fa fa-check"></i> Opslaan
                            </button>

                            <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-danger">
                                <i class="fa fa-undo"></i> Annuleren
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection