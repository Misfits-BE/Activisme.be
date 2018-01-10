@extends('layouts.front-end')

@section('content')
    <div class="container my-4">
        {{ Breadcrumbs::render('newsletter-create') }}
        @include('flash::message')

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> {{-- Card header --}}
                        <i class="fa fa-plus"></i> Nieuwsbrief toevoegen
                    </div> {{-- /// End card header --}}

                    <div class="card-body"> {{-- Card body --}}
                        <form id="create" method="POST" action="">
                            {{ csrf_field() }} {{-- Form field protection --}}

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Titel: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <input type="text" placeholder="De titel van de nieuwsbrief." class="form-control{{ $errors->has('titel') ? ' is-invalid' : '' }}" name="titel" value="{{ old('titel') }}">

                                    @if ($errors->has('titel'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('titel') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Status: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <select name="status" class="form-control{{ $errors->has('status') ? 'invalid' : '' }}">
                                        <option value="draft"  @if (old('status') === 'draft')  selected @endif>Klad versie</option>
                                        <option value="public" @if (old('status') === 'public') selected @endif>Publiceer</option>
                                    </select>

                                    @if ($errors->has('status'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <hr>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label text-lg-right">Verzenden: <span class="text-danger">*</span></label>

                                    <div class="col-lg-10">
                                        <select name="is_send" class="form-control{{ $errors->has('is_send') ? 'invalid' : '' }}">
                                            <option value="false" @if (old('is_send') == 'true')  selected @endif>Nee, ik wil deze nog niet verzenden.</option>
                                            <option value="true"  @if (old('is_send') == 'false') selected @endif>Ja, ik wil deze verzenden.</option>
                                        </select>

                                        @if ($errors->has('is_send'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('is_send') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            <hr>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Nieuwsbericht: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <textarea name="content" rows="7" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" placeholder="Het nieuwsbericht">{{ old('content') }}</textarea>

                                    @if ($errors->has('content'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div> {{-- /// Card body --}}

                    <div class="card-footer"> {{-- Card footer --}}
                        <span class="pull-right">
                            <button type="submit" form="create" class="btn btn-success btn-sm">
                                <i class="fa fa-check"></i> Opslaan
                            </button>

                            <a href="{{ route('admin.nieuwsbrief.index') }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-undo"></i> Annuleren
                            </a>
                        </span>
                    </div> {{-- /// Card footer --}}
                </div>
            </div>
        </div>
    </div>
@endsection