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
                        <form action="" method="POST">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection