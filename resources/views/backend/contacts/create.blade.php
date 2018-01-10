@extends('layouts.front-end')

@section('content')
    <div class="container my-4">
        {{ Breadcrumbs::render('contacts-create') }}

        <div class="row">
            <div class="col-md-12">
                <div class="mb-4 br-card card-shadow card">
                    <div class="card-header">
                        <i class="fa fa-fw fa-plus"></i> Contact toevoegen
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.contacts.store') }}" method="POST">
                            {{ csrf_field() }} {{-- Form protection --}}

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Naam: <span class="text-danger">*</span></label>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">E-mail adres: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <input type="text" placeholder="Het E-mail adres van de gebruiker" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Telefoon nr: <span class="text-danger">*</span></label>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Organisatie: <span class="text-danger">*</span></label>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection