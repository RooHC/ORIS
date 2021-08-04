@extends('layouts.app')

@section('content')
<div class="background-oris" id="area-personal">
    <div class="container pb-5 pt-3 text-center">
        <h1 class="text-white">{{ Auth::user()->name }}</h1>
        <h4 class="text-white pb-4">Área personal del profesor</h4>
    </div>
</div>
<div id="avatar-personal">
    <img src="{{ asset('images/avatar_prof.png') }}" class="rounded-circle bg-second-oris">
</div>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<section>
    <div class="container text-center">
        <h4 class="text-center font-weight-bold text-uppercase">{{$asignatura->subject_name}}</h4>
        <h5 class="text-center font-weight-bold">Código: {{$asignatura->subject_id}}</h5>
        <a class="btn btn-primary m-3" href={{ url('/profesor/' . Auth::user()->id) }} role="button">Volver</a>
        <nav>
            <div class="nav nav-tabs justify-content-center" id="nav-tab-presentaciones" role="tablist">
                <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab"
                    aria-controls="nav-all" aria-selected="true">PRESENTACIONES SUBIDAS</a>
            </div>
        </nav>
        <div class="album border-right border-left border-bottom bg-light p-4">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                    <div class="row">
                        @foreach ($presentaciones as $presentacion)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <div class="card-body">
                                    <h6 class="text-capitalize">{{ $presentacion->title }}</h6>
                                    <p class="card-text">{{ $presentacion->subject }}</p>
                                    <i class="fa fa-file-text display-2"></i>
                                    <div class="justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ url('/presentacion/'.$presentacion->id) }}">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-secondary">Ver</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{ $presentaciones->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center mt-4">
        <h5 class="text-center font-weight-bold">Listado de alumnos suscritos a la asignatura</h5>
        <div id="accordion">
            @foreach ($asignatura->suscriptores as $suscriptor)
            <div class="card">
                <div class="card-header" id="heading{{ $suscriptor->id }}">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $suscriptor->id }}"
                        aria-expanded="true" aria-controls="collapseOne">
                        <span class="m-3 text-dark">
                            {{ $suscriptor->name }}
                        </span>
                        <span class="badge badge-primary badge-pill">
                            <?php $count = 0; ?>
                            @foreach ($presentaciones as $presentacion)
                            @if($presentacion->user_id == $suscriptor->id)
                            <?php $count++; ?>
                            @endif
                            @endforeach
                            {{ $count }}
                        </span>
                    </button>
                </div>

                <div id="collapse{{ $suscriptor->id }}" class="collapse" aria-labelledby="heading{{ $suscriptor->id }}"
                    data-parent="#accordion">
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($presentaciones as $presentacion)
                            @if($presentacion->user_id == $suscriptor->id)
                            <a href="{{ url('/presentacion/'.$presentacion->id) }}" class="text-dark m-1">
                                <li class="list-group-item border">{{ $presentacion->title }}</li>
                            </a>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</section>
@endsection