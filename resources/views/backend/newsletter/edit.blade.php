@extends('layouts.front-end')

@section('content')
    <div class="container my-4">
        {{ Breadcrumbs::render('newsletter-edit') }}
        @include('flash::message')

        <div class="row"> {{-- Content --}}
            <div class="col-lg-12"> {{-- Card content --}}
                <div class="card card-shadow br-card"> {{-- Card --}}
                    <div class="card-header"> {{-- Card heading --}}
                        <i class="fa fa-pencil"></i> <strong>Wijzig:</strong> {{ $letter->titel }}
                    </div> {{-- /// Card heading --}}

                    <div class="card-body"> {{-- Card body --}}
                        <form id="edit" action="{{ route('admin.nieuwsbrief.update', ['slug' => $letter->slug]) }}" method="POST">
                            @form($letter) {{-- Bind database data to the form --}}

                            {{ csrf_field() }}          {{-- Form field protection --}}
                            {{ method_field('PATCH') }} {{-- Indicatie the HTTP/1 method --}}

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-lg-right">Titel: <span class="text-danger">*</span></label>
                            
                                <div class="col-lg-10">
                                    <input type="text" placeholder="De titel van de nieuwsbrief" class="form-control @error('titel', 'is-invalid')" @input('titel')>
                                    @error('titel')
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg col-form-label text-lg-right">Nieuwsbericht: <span class="text-danger">*</span></label>

                                <div class="col-lg-10">
                                    <textarea name="content" rows="7" class="form-control @error('content', 'is-invalid')" placeholder="Het nieuwsbericht">{{ $letter->content }}</textarea>
                                </div>
                            </div>
                        </form>
                    </div> {{-- /// Card body --}}

                    <div class="card-footer"> {{-- Card footer --}}
                        <span class="pull-right">
                            <button type="submit" form="edit" class="btn btn-sm btn-success">
                                <i class="fa fa-check"></i> Wijzigen
                            </button>

                            <a href="{{ route('admin.nieuwsbrief.index') }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-undo"></i> Annuleren
                            </a>
                        </span>
                    </div> {{-- /// Card footer --}}
                </div> {{-- /// Card --}}
            </div> {{-- /// Card content --}}
        </div> {{-- /// Content --}}
    </div>
@endsection