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
                        <form id="edit" action="" method="POST">
                            {{ csrf_field() }}          {{-- Form field protection --}}
                            {{ method_field('PATCH') }} {{-- Indicatie the HTTP/1 method --}}
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