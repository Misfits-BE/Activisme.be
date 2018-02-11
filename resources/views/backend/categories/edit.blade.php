@extends('layouts.front-end')

@section('content')
    <div class="container my-4">
        {{ Breadcrumbs::render('categories-edit') }}  {{-- Breadcrumb view instance --}}
        @include('flash::message')                      {{-- Flash session view instance --}}
    
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 br-card card-shadow">
                    
                    <div class="card-header">
                        <i class="fa fa-fw fa-plus"></i> Categorie toevoegen
                    </div>

                    <div class="card-body">
                        <form id="new-category" action="{{ route('admin.categories.update', $category) }}" method="POST">
                            {{ csrf_field() }}          {{-- Form field protection --}}
                            {{ method_field('PATCH') }} {{-- Converteer de HTTP/1 method van POST naar PATCH --}}

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Naam: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <input type="text" placeholder="Naam van de categorie" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $category->name or old('name') }}">
                                
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Beschrijving: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <textarea name="description" rows="7" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Korte beschrijving van de categorie">{{ $category->description or old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="card-footer">
                        <span class="pull-right">
                            <button type="submit" form="new-category" class="btn btn-sm btn-success">
                                <i class="fa fa-check"></i> Opslaan
                            </button>

                            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-danger">
                                <i class="fa fa-undo"></i> Annuleren
                            </a>
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection