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
        <h5 class="text-center font-weight-bold text-secondary">Código: {{$asignatura->subject_id}}</h5>
        <a class="btn btn-primary m-3" href={{ url('/profesor/' . Auth::user()->id) }} role="button">Volver</a>
        <div id="accordion">
            @foreach ($asignatura->suscriptores as $suscriptor)
            <div class="card">
                <div class="card-header" id="heading{{ $suscriptor->id }}">
                    <div class="row">
                        <div class="col p-2">
                            <span class="mx-3 text-dark float-left">
                                <strong>Alumno: </strong>{{ $suscriptor->name }} ({{$suscriptor->email}})
                            </span>
                        </div>
                        <div class="col-auto p-2">
                            <?php $count = 0; ?>
                            @foreach ($presentaciones as $presentacion)
                            @if($presentacion->user_id == $suscriptor->id)
                            <?php $count++; ?>
                            @endif
                            @endforeach
                            <span class="m-3 text-dark">
                                <strong>Presentaciones: </strong>{{ $count }}
                            </span>
                        </div>
                        <div class="col-auto">
                            <button class="float-right btn btn-primary" data-toggle="collapse"
                                data-target="#collapse{{ $suscriptor->id }}" aria-expanded="true"
                                aria-controls="collapseOne">
                                Ver presentaciones
                            </button>
                        </div>
                        <div class="col-auto">
                            <form action="{{route('suscripcion.destroy', [$suscriptor, $asignatura])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="float-right btn btn-danger">
                                    Eliminar usuario
                                </button>
                            </form>
                        </div>
                    </div>
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