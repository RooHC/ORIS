@extends('layouts.app')

@section('content')
<div class="background-oris" id="area-personal">
    <div class="container pb-5 pt-3 text-center">
        <h1 class="text-white">{{ $user->name }}</h1>
        <h4 class="text-white pb-4">Área personal del profesor</h4>
    </div>
</div>
<div id="avatar-personal">
    <img src="{{ asset('images/avatar_prof.png') }}" class="rounded-circle bg-second-oris">
</div>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<div class="container mb-5">
    <div class="row text-center">
        <div class="col-sm">
            <a href="{{ url('/asignatura/create') }}">
                <button class="btn btn-primary">CREAR UNA <br> ASIGNATURA</button>
            </a>
        </div>
    </div>
</div>

<section>
    <div class="container-sm text-center">
        <h4 class="text-center font-weight-bold">MIS ASIGNATURAS</h4>
        <div class="album border-right border-left border-bottom border-top bg-light p-4">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="misAsignaturas" role="tabpanel">
                    @foreach ($asignaturas as $asignatura)
                    <a href={{ url('/asignatura/'.$asignatura->id) }}>
                        <div class="card m-4 box-shadow">
                            <div class="card-body">
                                <h6 class="text-capitalize">{{ $asignatura->subject_name }}</h6>
                                <p class="card-text"><strong>Código: </strong>{{ $asignatura->subject_id }}</p>
                                <i class="fa fa-file-text display-4"></i>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    {{ $asignaturas->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection