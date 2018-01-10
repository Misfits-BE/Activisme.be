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

                    </div> {{-- /// Card body --}}
                </div>
            </div>
        </div>
    </div>
@endsection