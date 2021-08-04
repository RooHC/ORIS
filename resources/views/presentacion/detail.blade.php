@extends('layouts.app')

@section('content')
{{-- MENSAJES DE SUGERENCIA --}}
<div class="container">
    <div id="sugerencias" class="row px-3 pt-4 mx-auto my-0">
        <div class="card shadow  w-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Respuestas los alumnos</h6>
            </div>
            <div class="card-body">
                @if($pregunta->respuestas->count())
                <div class="mb-2">
                    <a class="text-dark font-weight-bold">{{ $pregunta->question }}</a>
                    <span class="text-muted text-sm">
                        <small>{{$pregunta->respuestas->count()}}
                            {{Str::plural('respuesta', $pregunta->respuestas->count())}}</small>
                    </span>
                </div>
                <div>
                    <?php 
                    $success_A="";
                    $success_B="";
                    $success_C="";
                    ?>
                    @if($pregunta->solution == "option_A")
                    <?php $success_A="text-success"?>
                    @elseif($pregunta->solution == "option_B")
                    <?php $success_B="text-success"?>
                    @elseif($pregunta->solution == "option_C")
                    <?php $success_C="text-success"?>
                    @endif
                    <?php 
                    $usersOptA = array();
                    $usersOptB = array();
                    $usersOptC = array();
                    ?>
                    @foreach ($pregunta->respuestas as $respuesta)
                    @if($respuesta->answer == "option_A")
                    <?php array_push($usersOptA, $respuesta->user->name) ?>
                    @elseif($respuesta->answer == "option_B")
                    <?php array_push($usersOptB, $respuesta->user->name) ?>
                    @elseif($respuesta->answer == "option_C")
                    <?php array_push($usersOptC, $respuesta->user->name) ?>
                    @endif
                    @endforeach
                    <ul id="respuestasAlumnos">
                        <li>
                            <input type="checkbox" name="list" id="option_A">
                            <label for="option_A" class="{{$success_A}} mb-1">
                                <strong>Opcion A: </strong>{{$pregunta->option_A}}
                            </label>
                            <ul class="interior">
                                @foreach ($usersOptA as $userOptA)
                                <li><a>{{$userOptA}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <input type="checkbox" name="list" id="option_B">
                            <label for="option_B" class="{{$success_B}} mb-1">
                                <strong>Opcion B: </strong>{{$pregunta->option_B}}
                            </label>
                            <ul class="interior">
                                @foreach ($usersOptB as $userOptB)
                                <li><a>{{$userOptB}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <input type="checkbox" name="list" id="option_C">
                            <label for="option_C" class="{{$success_C}} mb-1">
                                <strong>Opcion C: </strong>{{$pregunta->option_C}}
                            </label>
                            <ul class="interior">
                                @foreach ($usersOptC as $userOptC)
                                <li><a>{{$userOptC}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
                @else
                <p class="text-dark font-weight-bold">No hay respuestas</p>
                @endif
            </div>
        </div>
    </div>
</div>
{{-- FIN MENSAJES DE SUGERENCIA --}}

@endsection