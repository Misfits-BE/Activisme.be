@extends('layouts.front-end')

@section('content')
    <div class="container my-4">
        {{ Breadcrumbs::render('calendar-create') }}

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-calendar"></i> Evenement toevoegen aan de kalender.
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.calendar.store') }}" method="POST" id="store-event">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <div class="alert alert-warning">
                                        <strong><i class="fa fa-warning"></i> Info:</strong>
                                        Gelieve evenementen die meerdere dagen duren per dag aan te maken.
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Naam: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <input type="text" placeholder="Naam evenement" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" name="name">

                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Status: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <select name="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}">
                                        <option value="">-- Selecteer de publicatie status --</option>

                                        {{-- Publicatie statussen --}}
                                        <option value="public" @if (old('status') == 'public') selected @endif>Publiceer evenement</option>
                                        <option value="draft"  @if (old('status') == 'draft')  selected @endif>Klade versie van een evenement</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Start tijdstip: <span class="text-danger">*</span></label>

                                <div class="col-lg-5">
                                    <input type="date" name="start_date" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" value="{{ date("Y-m-d") }}">

                                    @if ($errors->has('start_date'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('start_date') }}</strong>
                                        </div>
                                    @else {{-- Geen errors gevonden geef gewoon de help text weer. --}}
                                        <small class="form-text text-muted"><span class="text-danger">*</span> Standaard formaat voor de datum = DD/MM/YYYY</small>
                                    @endif
                                </div>

                                <div class="col-lg-5">
                                    <input type="time" name="start_time" class="form-control{{ $errors->has('start_time' ? ' is-invalid' : '') }}" value="{{ date('H:i') }}">

                                    @if ($errors->has('start_time'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('start_time') }}</strong>
                                        </div>
                                    @else
                                        {{-- TODO: Implement time help text --}}
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Eind tijdstip: <span class="text-danger">*</span></label>

                                <div class="col-lg-5">
                                    <input type="date" name="end_date" class="form-control{{ $errors->has('end_date' ? ' is-invalid' : '') }}" value="{{ date('Y-m-d') }}">

                                    @if ($errors->has('end_date'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('end_date') }}</strong>
                                        </div>
                                    @else
                                        <small class="form-text text-muted"><span class="text-danger">*</span> Standaard formaat voor de datum = DD/MM/YYYY</small>
                                    @endif
                                </div>

                                <div class="col-lg-5">
                                    <input type="time" name="end_time" class="form-control{{ $errors->has('end_time' ? ' is-invalid' : '') }}" value="{{ date('H:i') }}">

                                    @if ($errors->has('end_time'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('end_time') }}</strong>
                                        </div>
                                    @else
                                        {{-- TODO: Implement time help test --}}
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer">
                        <span class="pull-right">
                            <button type="submit" form="store-event" class="btn btn-sm btn-success">
                                <i class="fa fa-check"></i> Opslaan
                            </button>

                            <a href="{{ route('admin.calendar.index') }}" class="btn btn-sm btn-danger">
                                <i class="fa fa-undo"></i> Annuleren
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection