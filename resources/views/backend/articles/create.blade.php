@extends('layouts.front-end')

@section('content')
    <div class="container my-4 pb-4">
        {{ Breadcrumbs::render('articles-create') }}

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-fw fa-plus"></i> Artikel toevoegen
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.articles.store') }}" method="POST" id="create-article" enctype="multipart/form-data">
                            {{ csrf_field() }} {{-- Form field protection --}}

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Publicatie datum: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <input type="date" value="{{ date("Y-m-d") }}" name="publish_date" class="form-control{{ $errors->has('publish_date') ? ' is-invalid' : '' }}">

                                    @if ($errors->has('publish_date'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('publish_date') }}</strong>
                                        </div>
                                    @else {{-- Geen errors gevonden geef gewoon de help text weer. --}}
                                        <small class="form-text text-muted"><span class="text-danger">*</span> Standaard formaat voor de datum = YYYY/MM/DD</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Status: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <select name="is_published"  class="form-control{{ $errors->has('is_published') ? ' is-invalid' : '' }}">
                                        <option value="">-- Selecteer de status van het nieuwsbericht --</option>
                                        <option value="Y" @if (old('is_published') == 'Y') selected @endif>Publiceer het nieuws bericht</option>
                                        <option value="N" @if (old('is_published') == 'N') selected @endif>Registreer het nieuwsbericht als klad versie.</option>
                                    </select>

                                    @if ($errors->has('is_published'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('is_published') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <hr> {{-- Break line is nodig om de settings te onderscheiden van het actuele bericht. --}}

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Afbeelding: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <input type="file" name="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}">

                                    @if ($errors->has('image'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Titel: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" name="title" placeholder="De titel van het nieuwsbericht">

                                    @if ($errors->has('title'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Categorieen: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <input type="text" class="form-control{{ $errors->has('categories') ? ' is-invalid' : '' }}" value="{{ old('categories') }}" name="categories" placeholder="De categorieen voor het bericht">

                                    @if ($errors->has('categories'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('categories') }}</strong>
                                        </div>
                                    @else {{-- Geen validatie fouten gevonden dus geef gewoon de help tekst weer --}}
                                        <small class="form-text text-muted">
                                            <span class="text-danger">*</span> Categorieen worden gescheiden door een comma. bv: cat1, cat2, enz...
                                        </small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Bericht: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <textarea name="message" id="editor1" rows="7" placeholder="Uw nieuwsbericht" class="form-control{{ $errors->has('message') ? ' is-invalid' : ''}}">{{ old('message') }}</textarea>

                                    @if ($errors->has('message'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer">
                        <span class="pull-right">
                            <button type="submit" form="create-article" class="btn btn-sm btn-success">
                                <i class="fa fa-check"></i> Opslaan
                            </button>

                            <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-danger">
                                <i class="fa fa-undo"></i> Annuleren
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('editor1');
    </script>
@endpush