@extends('layouts.front-end')

@section('content')
    <div class="container my-4">
        {{ Breadcrumbs::render('calendar-edit') }}

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-calendar"></i> Wijzig een evenement in de kalender.
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.calendar.update', $event) }}" method="POST" id="store-event">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}

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
                                    <input type="text" placeholder="Naam evenement" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $event->name }}" name="name">

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
                                        <option value="public" @if ($event->status == 'public') selected @endif>Publiceer evenement</option>
                                        <option value="draft"  @if ($event->status == 'draft')  selected @endif>Klad versie van een evenement</option>
                                    </select>
                                    
                                    @if ($errors->has('status'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Start tijdstip: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <input type="text" name="start_date" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" value="{{ $event->dates()->first()->start_date->format('Y-m-d') }}">

                                    @if ($errors->has('start_date'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('start_date') }}</strong>
                                        </div>
                                    @else {{-- Geen errors gevonden geef gewoon de help text weer. --}}
                                        <small class="form-text text-muted"><span class="text-danger">*</span> Standaard formaat voor de datum = YYYY-MM-DD</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Uren: <span class="text-danger">*</span></label>

                                <div class="col-lg-5">
                                    <input type="time" name="start_time" class="form-control{{ $errors->has('start_time' ? ' is-invalid' : '') }}" value="{{ $event->start_time }}">

                                    @if ($errors->has('start_time'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('start_time') }}</strong>
                                        </div>
                                    @else
                                       <small class="form-text test-muted"><span class="text-danger">*</span> Start uur</small>
                                    @endif
                                </div>

                                <div class="col-lg-5">
                                    <input type="time" name="end_time" class="form-control{{ $errors->has('end_time' ? ' is-invalid' : '') }}" value="{{ $event->end_time }}">

                                    @if ($errors->has('end_time'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('end_time') }}</strong>
                                        </div>
                                    @else
                                        <small class="form-text test-muted"><span class="text-danger">*</span> Eind uur</small>
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