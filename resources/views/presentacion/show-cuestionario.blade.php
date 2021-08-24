<?php
    $rubricas = array("Contenido", "Organización de la información", "Calidad de la exposición", "Tiempo", "Valoración general");
    $names = array("contenido", "organizacion", "exposicion", "tiempo", "valoracion");
    $colors = array("","bg-danger","bg-warning","bg-info","bg-success");
    $descriptions1 = array("El contenido ha reflejado la idea central de la presentación y su objetivo (persuadir, informar,
                        etc.), observandose que se han consultado fuentes relevantes sobre el tema.",
                        "El presentador ha organizado la información que ha presentado de forma correcta, pudiendose
                        identificar una introduccion bien desearrollada, un cuerpo y una conclusión.",
                        "Se muestra un dominio del contenido. El estudiante entiende lo que dice y transmite los
                        contenidos al resto de los compañeros.",
                        "La presentación se ha adaptado al tiempo establecido. En caso de haber varios presentadores, se
                        han repartido el tiempo de exposicion a partes iguales.",
                        "Mediante estas estadísticas podras ver en qué mejorar en tus proximas presentaciones orales.");
    $descriptions2 = array("El contendio de la presentacion apoya el discurso, no solo se limita a reproducirlo.",
                        "Además, ha hecho un uso adecuado de recursos visuales y/o tecnológicos para enriquecer su presentación.",
                        "El presentador ha mantenido la atención en los espectadores. Evitando limitarse a
                        leer únicamente lo que está escrito en su presentación.",
                        "",
                        "La valoración general se genera a partir de una media entre los distintos criterios
                        que han sido evaluados por los oyentes.");
?>

@extends('layouts.app-presentacion')

@section('content')
@can('view', $presentacion)
{{-- MOSTRAR LA PRESENTACION --}}
<div class="bg-presentacion">
    <div class="container">
        <div class="row py-4" id="pantalla">
            <div class="embed-responsive embed-responsive-21by9 border border-white">
                <iframe class="embed-responsive-item" src="{{ asset('storage/' . $presentacion->file) }}"></iframe>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-light bg-nav shadow-sm p-0">
        <div class="container">
            <div class="row py-4 text-center w-100">
                <div class="col-sm">
                    <h5 class="mb-0 text-white">{{ $presentacion->user->name }}</h5>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-0 text-white">ID de la reunión: <strong>{{ $presentacion->meeting_id }}</strong></h5>
                </div>
                <div class="col-sm">
                    <h5 class="mb-0 text-white">{{ $asignatura->subject_name }}</h5>
                </div>
            </div>
        </div>
    </nav>
</div>
{{-- FIN MOSTRAR LA PRESENTACION --}}

{{-- CUESTIONARIO PRESENTACION --}}
<div class="container px-cuestionario mt-5" id="evaluacion">
    <h3 class="font-size-cuestionario">Evaluación de la presentación</h3>
    <p class="descripcion-cuestionario">
        <strong>¿Quieres decirme algo?</strong> A través de este formulario puedes enviarme un mensaje para
        ayudarme a corregir errores, a mejorar mi presentación, o simplemente para decir hola. Cualquier
        cosa que tengas para decir es bienvenida, así que no lo dudes y evalúa mi presentación!
    </p>
    <form action="{{ route('respuesta.store') }}" method="POST">
        @csrf
        <fieldset class="cuestionario">
            <legend class="cuestionario">Preguntas sobre la presentación</legend>

            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @elseif(session()->has('fail'))
            <div class="alert alert-danger">
                {{ session()->get('fail') }}
            </div>
            @endif

            <?php $count=1 ?>
            @foreach ($presentacion->preguntas as $pregunta)
            <input name="pregunta_{{$count}}" type="hidden" value="{{$pregunta->id}}">
            <p class="pregunta-cuestionario mb-0">{{$pregunta->question}}</p>

            {{-- Si aun no ha respondido al cuestionario, se muestran las preguntas --}}
            @can('view', $pregunta)
            <div class="form-check mx-4 my-2">
                <input class="form-check-input" type="radio" name="respuesta_{{$count}}" value="option_A" required>
                <label class="form-check-label" for="option_A">
                    {{$pregunta->option_A}}
                </label>
            </div>
            <div class="form-check mx-4 my-2">
                <input class="form-check-input" type="radio" name="respuesta_{{$count}}" value="option_B">
                <label class="form-check-label" for="option_B">
                    {{$pregunta->option_B}}
                </label>
            </div>
            <div class="form-check mx-4 my-2">
                <input class="form-check-input" type="radio" name="respuesta_{{$count}}" value="option_C">
                <label class="form-check-label" for="option_C">
                    {{$pregunta->option_C}}
                </label>
            </div>
            @endcan

            {{-- Si ya ha respondido al cuestionario, se muestran las soluciones --}}
            @cannot('view', $pregunta)
            <?php 
            $success_A="";
            $success_B="";
            $success_C="";
            ?>
            @if($pregunta->solution == "option_A")
            <?php $success_A="text-success font-weight-bold"?>
            @elseif($pregunta->solution == "option_B")
            <?php $success_B="text-success font-weight-bold"?>
            @elseif($pregunta->solution == "option_C")
            <?php $success_C="text-success font-weight-bold"?>
            @endif
            @foreach ($pregunta->respuestas as $respuesta)
            @if($respuesta->user_id==Auth::user()->id)
            <?php 
            $checked_A="";
            $checked_B="";
            $checked_C="";
            ?>
            @if($respuesta->answer == "option_A")
            <?php $checked_A="checked"?>
            @elseif($respuesta->answer == "option_B")
            <?php $checked_B="checked"?>
            @elseif($respuesta->answer == "option_C")
            <?php $checked_C="checked"?>
            @endif
            <div class="form-check mx-4 my-2">
                <input class="form-check-input" type="radio" name="respuesta_{{$count}}" value="option_A" {{$checked_A}}
                    disabled>
                <label class="form-check-label {{$success_A}}" for="option_A">
                    {{$pregunta->option_A}}
                </label>
            </div>
            <div class="form-check mx-4 my-2">
                <input class="form-check-input" type="radio" name="respuesta_{{$count}}" value="option_B" {{$checked_B}}
                    disabled>
                <label class="form-check-label {{$success_B}}" for="option_B">
                    {{$pregunta->option_B}}
                </label>
            </div>
            <div class="form-check mx-4 my-2">
                <input class="form-check-input" type="radio" name="respuesta_{{$count}}" value="option_C" {{$checked_C}}
                    disabled>
                <label class="form-check-label {{$success_C}}" for="option_C">
                    {{$pregunta->option_C}}
                </label>
            </div>
            @endif
            @endforeach
            @endcannot
            <br>
            <?php $count++; ?>
            @endforeach
        </fieldset>

        {{-- Si ya has enviado una evaluacion, no se mostrará --}}
        @can('view', $pregunta)
        <fieldset class="cuestionario mt-4">
            <legend class="cuestionario">Valoración de la presentación</legend>
            @foreach ($rubricas as $rubrica)
            <p class="pregunta-cuestionario mb-0">
                {{$rubrica}} <i class="fa fa-question-circle" id="fa-question-circle" data-toggle="modal"
                    data-target="#info-{{$names[$loop->index]}}"></i>
            </p>
            <fieldset class="rating">
                @for ($j = 5; $j >= 1; $j--)
                <input type="radio" id="star{{$j}}{{$names[$loop->index]}}" name="{{$names[$loop->index]}}"
                    value="{{$j}}" required />
                <label class="full" for="star{{$j}}{{$names[$loop->index]}}" title="{{$j}} stars"></label>
                @endfor
            </fieldset>
            <div class="modal fade" id="info-{{$names[$loop->index]}}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary">{{$rubrica}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>{{$descriptions1[$loop->index]}}</p>
                            <p class="mb-0">{{$descriptions2[$loop->index]}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="form-group">
                <label class="pregunta-cuestionario" for="consejo">¿Quieres darme algún consejo?</label>
                <textarea class="form-control my-2" id="consejo" name="consejo" rows="3"
                    placeholder=" Mensaje"></textarea>
            </div>
            <input name="presentacion_id" type="hidden" value="{{$presentacion->id}}">
        </fieldset>
        <div class="text-center p-4">
            <button type="submit" class="btn btn-danger">ENVIAR</button>
        </div>
        @endcan
    </form>
</div>
{{-- FIN CUESTIONARIO PRESENTACION --}}

{{-- MENSAJES DE SUGERENCIA --}}
<div class="container">
    @cannot('view', $pregunta)
    <div id="sugerencias" class="row px-3 pt-4 mx-auto my-0">
        <div class="card shadow  w-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Comentarios sobre la presentación</h6>
            </div>
            <div class="card-body">
                @if($opiniones->count())
                @foreach ($opiniones as $opinion)
                <div class="mb-4">
                    @if($opinion->visible)
                    <a class="text-dark font-weight-bold">Comentario {{ $loop->index + 1 }}</a>
                    <span class="text-muted text-sm">
                        <small>{{$opinion->created_at->diffForHumans()}}</small>
                    </span>
                    <p class="mb-2">{{$opinion->consejo}}</p>
                    <div class="d-flex flex-row">
                        <span class="font-italic">
                            {{$opinion->likes->count()}}
                            {{Str::plural('like', $opinion->likes->count())}}
                        </span>
                        @if (!$opinion->likedBy(auth()->user()))
                        <form action="{{route('like.store', $opinion)}}" method="POST" class="mx-1">
                            @csrf
                            <button type="submit" class="btn btn-link p-0">
                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                            </button>
                        </form>
                        @else
                        <form action="{{route('like.destroy', $opinion)}}" method="POST" class="mx-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link p-0">
                                <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                    @endif
                </div>
                @endforeach
                {{ $opiniones->links() }}
                @else
                <p class="text-dark font-weight-bold">No hay opiniones</p>
                @endif
            </div>
        </div>
    </div>

    <div class="text-center pt-4">
        <a href={{ url('/'.Auth::user()->role->name.'/'.Auth::user()->id) }}>
            <button type="button" class="btn btn-danger">SALIR</button>
        </a>
    </div>
    @endcannot
</div>
{{-- FIN MENSAJES DE SUGERENCIA --}}
@endcan
@endsection