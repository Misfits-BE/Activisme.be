@extends('layouts.front-end')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-1 col-10 mt-4 mb-4">
                @include('flash::message')

                <div class="card br-card card-shadow">
                    <div class="card-header">
                        <i class="fa fa-bug fa-fw"></i> Meld een probleem
                    </div>

                    <div class="card-body">
                        <form role="form" method="POST" action="{{ route('bug.create') }}">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="alert alert-warning alert-important">
                                        <i class="fa fa-warning"></i> <strong>Waarschuwing:</strong>
                                        Uw gegeven invoer word publiekelijk in GitHub geplaatst.
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-4 col-form-label text-lg-right">Titel van het probleem: <span class="text-danger">*</span></label>

                                <div class="col-8">
                                    <input type="text" placeholder="De titel van het probleem" class="form-control{{ $errors->has('titel') ? ' is-invalid' : '' }}" value="{{ old('titel') }}" name="titel">

                                    @if ($errors->has('titel'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('titel') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-4 col-form-label text-lg-right">Aard van het probleem: <span class="text-danger">*</span></label>

                                <div class="col-8">
                                    <select name="label" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}">
                                        <option value="">-- Selecteer de aard van het probleem. --</option>

                                        @foreach ($labels as $label) {{-- Loop through the github issues --}}
                                            <option value="{{ $label['name'] }}" @if ($label['name'] == old('label')) selected @endif>{{ $label['name'] }}</option>
                                        @endforeach {{-- /END loop --}}
                                    </select>

                                    @if ($errors->has('label'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('label') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-4 col-form-label text-lg-right">Beschrijving van het probleem: <span class="text-danger">*</span></label>

                                <div class="col-8">
                                    <textarea rows="7" class="form-control{{ $errors->has('beschrijving') ? ' is-invalid' : '' }}" name="beschrijving" placeholder="Wat loopt er mis?">{{ old('beschrijving') }}</textarea>

                                    @if ($errors->has('beschrijving'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('beschrijving') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-8 offset-4">
                                    <button type="submit" style="border-radius: 3px;" class="btn btn-sm btn-success">
                                        <i class="fa fa-send"></i> Verzenden
                                    </button>

                                    <button type="reset" style="border-radius: 3px;" class="btn btn-sm btn-danger">
                                        <i class="fa fa-undo"></i> Annuleren
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection