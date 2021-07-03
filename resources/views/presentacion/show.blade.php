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
{{-- MOSTRAR LA PRESENTACION --}}
<div class="bg-presentacion">
    <div class="container">
        <div class="row py-4" id="exposicion">
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
                    <h5 class="mb-0 text-white">{{ $presentacion->subject }}</h5>
                </div>
            </div>
        </div>
    </nav>
</div>
{{-- FIN MOSTRAR LA PRESENTACION --}}

{{-- ALUMNO PRESENTADOR --}}
@can('update', $presentacion)
<div class="container">
    {{-- ESTADISTICAS GENERALES --}}
    <div id="estadisticas-generales" class="row pt-4">
        <div class="col-xl-3 col-md-6 ">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{ url()->current() }}#respuestas">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Número de respuestas
                                </div>
                            </a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$presentacion->participants}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-users fa-2x text-gray-300" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 ">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Respuestas correctas</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <?php 
                                        $correct_answers = 0;
                                        $number_answers = 0;
                                    ?>
                                    @foreach ($presentacion->preguntas as $pregunta)
                                        <?php 
                                            $correct_answers = $correct_answers + $pregunta->correct_answers; 
                                            $number_answers = $number_answers + $pregunta->respuestas->count();
                                        ?>
                                    @endforeach
                                    <?php
                                        if($number_answers == 0){
                                            $correctas = 0;
                                        }else{
                                            $correctas = number_format((($correct_answers/$number_answers)*100),0); 
                                        }
                                    ?>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$correctas}}%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$correctas}}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 ">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{ url()->current() }}#rubrica-valoracion">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Valoración de la presentación
                                </div>
                            </a>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <?php $valoracion_total = 0; ?>
                                    @foreach ($presentacion->opiniones as $opinion)
                                        <?php 
                                            $valoracion_total = number_format((($opinion::where('presentacion_id', $presentacion->id)->avg('valoracion'))),0);
                                        ?>
                                    @endforeach
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$valoracion_total}}/5</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{$valoracion_total*2*10}}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 ">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{ url()->current() }}#sugerencias">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Mensajes de sugerencia</div>
                            </a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$presentacion->opiniones->count()}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-comments-o fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- FIN ESTADISTICAS GENERALES --}}

    {{-- ESTADISTICAS PREGUNTAS Y RESPUESTAS --}}
    <div id="estadisticas-preguntas" class="row pt-4">
        <div class="col-lg-6">
            <div class="shadow" id="preguntas">
                <?php $num_pregunta=1 ?>
                @foreach ($presentacion->preguntas as $pregunta)
                    <div class="card">
                        <div class="card-header py-2">
                            <h6 class="m-0">
                                <button class="btn btn-link py-1 px-0" data-toggle="collapse"
                                    data-target="#collapse{{$num_pregunta}}">
                                    <strong>Pregunta {{$num_pregunta}}</strong>
                                </button>
                            </h6>
                        </div>
                        <div id="collapse{{$num_pregunta}}" class="collapse" data-parent="#preguntas">
                            <div class="card-body">
                                <p>{{$pregunta->question}}</p>
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
                                <p class="ml-2 {{$success_A}}"><strong>Opcion A: </strong>{{$pregunta->option_A}}</p>
                                <p class="ml-2 {{$success_B}}"><strong>Opcion B: </strong>{{$pregunta->option_B}}</p>
                                <p class="ml-2 {{$success_C}}"><strong>Opcion C: </strong>{{$pregunta->option_C}}</p>
                            </div>
                        </div>
                    </div>
                    <?php $num_pregunta++ ?>
                @endforeach
            </div>
        </div>
        <div class="col-lg-6">
            <div class="shadow" id="respuestas">
                <?php $num_pregunta=1 ?>
                @foreach ($presentacion->preguntas as $pregunta)
                    <div class="card">
                        <div class="card-header py-2">
                            <h6 class="m-0">
                                <button class="btn btn-link py-1 px-0" data-toggle="collapse"
                                    data-target="#collapse{{$num_pregunta}}">
                                    <strong>Respuestas pregunta {{$num_pregunta}}</strong>
                                </button>
                            </h6>
                        </div>
                        <div id="collapse{{$num_pregunta}}" class="collapse" data-parent="#respuestas">
                            <div class="card-body">
                                <?php 
                                    $numRespuestas = $pregunta->respuestas->count();
                                    $numOptionA = 0;
                                    $numOptionB = 0;
                                    $numOptionC = 0;
                                ?>
                                @foreach ($pregunta->respuestas as $respuesta)
                                    <?php
                                        if($respuesta->answer == "option_A"){
                                            $numOptionA++;
                                        }elseif($respuesta->answer == "option_B"){
                                            $numOptionB++;
                                        }else{
                                            $numOptionC++;
                                        }
                                    ?>
                                @endforeach
                                <?php 
                                    $numRespuestas = $pregunta->respuestas->count();
                                    if($numRespuestas != 0){
                                       $numOptionA = number_format((($numOptionA/$numRespuestas)*100),0);
                                        $numOptionB = number_format((($numOptionB/$numRespuestas)*100),0);
                                        $numOptionC = number_format((($numOptionC/$numRespuestas)*100),0); 
                                    }
                                ?>
                                <h4 class="small font-weight-bold">Opción A <span class="float-right">{{$numOptionA}}%</span></h4>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{$numOptionA}}%"></div>
                                </div>
                                <h4 class="small font-weight-bold">Opción B <span class="float-right">{{$numOptionB}}%</span></h4>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{$numOptionB}}%"></div>
                                </div>
                                <h4 class="small font-weight-bold">Opción C <span class="float-right">{{$numOptionC}}%</span></h4>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$numOptionC}}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $num_pregunta++ ?>
                @endforeach
            </div>
        </div>
    </div>
    {{-- FIN ESTADISTICAS PREGUNTAS Y RESPUESTAS --}}

    {{-- ESTADISTICAS VALORACIONES PRESENTACION --}}
    <div id="estadisticas-valoraciones" class="row pt-4">
        <div class="col-lg-6 ">
            <div class="card shadow ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Criterios</h6>
                </div>
                <?php $porcentajes = array(0,0,0,0,0); ?>
                @foreach ($presentacion->opiniones as $opinion)
                    <?php
                    $contenido = number_format((($opinion::where('presentacion_id', $presentacion->id)->avg('contenido'))),0);
                    $organizacion = number_format((($opinion::where('presentacion_id', $presentacion->id)->avg('organizacion'))),0);
                    $exposicion = number_format((($opinion::where('presentacion_id', $presentacion->id)->avg('exposicion'))),0);
                    $tiempo = number_format((($opinion::where('presentacion_id', $presentacion->id)->avg('tiempo'))),0);
                    $valoracion = number_format((($opinion::where('presentacion_id', $presentacion->id)->avg('valoracion'))),0);
                    $porcentajes = array($contenido, $organizacion, $exposicion, $tiempo, $valoracion);
                    ?>
                @endforeach
                <div class="card-body">
                    @for ($i = 0; $i < count($rubricas); $i++) 
                        <div id="{{$names[$i]}}">
                            <h4 class="small font-weight-bold">{{$rubricas[$i]}} <span class="float-right">{{$porcentajes[$i]}}/5</span></h4>
                            <div class="progress mb-3">
                                <div class="progress-bar {{$colors[$i]}}" role="progressbar" style="width: {{$porcentajes[$i]*2*10}}%"></div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        @for ($i = 0; $i < count($rubricas); $i++) 
            <div class="col-lg-6 " id="rubrica-{{$names[$i]}}">
                <div class="card shadow ">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{$rubricas[$i]}}</h6>
                    </div>
                    <div class="card-body">
                        <p>{{$descriptions1[$i]}}</p>
                        <p class="mb-0">{{$descriptions2[$i]}}</p>
                    </div>
                </div>
            </div>
        @endfor
    </div>
    {{-- FIN ESTADISTICAS VALORACIONES PRESENTACION --}}
</div>
@endcan
{{-- FIN ALUMNO PRESENTADOR --}}


{{-- ALUMNO OYENTE --}}
@can('view', $presentacion)
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
            @for ($i = 0; $i < count($rubricas); $i++) 
                <p class="pregunta-cuestionario mb-0">
                    {{$rubricas[$i]}} <i class="fa fa-question-circle" id="fa-question-circle" data-toggle="modal"
                    data-target="#info-{{$names[$i]}}"></i>
                </p>
                <fieldset class="rating">
                    @for ($j = 5; $j >= 1; $j--)
                        <input type="radio" id="star{{$j}}{{$names[$i]}}" name="{{$names[$i]}}" value="{{$j}}" required />
                        <label class="full" for="star{{$j}}{{$names[$i]}}" title="{{$j}} stars"></label>
                    @endfor
                </fieldset>
                <div class="modal fade" id="info-{{$names[$i]}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-bold text-primary">{{$rubricas[$i]}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>{{$descriptions1[$i]}}</p>
                                <p class="mb-0">{{$descriptions2[$i]}}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
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
@endcan
{{-- FIN ALUMNO OYENTE --}}

{{-- MENSAJES DE SUGERENCIA --}}
<div class="container">
    <div id="sugerencias" class="row px-3 pt-4 mx-auto my-0">
        <div class="card shadow  w-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sugerencias</h6>
            </div>
            <div class="card-body">
                @if($opiniones->count())
                    @foreach ($opiniones as $opinion)
                    <div class="mb-4">
                        <a class="text-dark font-weight-bold">Comentario</a> 
                        <span class="text-muted text-sm">
                            <small>{{$opinion->created_at->diffForHumans()}}</small>
                        </span>
                        <p class="mb-2">{{$opinion->consejo}}</p>
                        <div class="d-flex flex-row">
                            @if (!$opinion->likedBy(auth()->user()))
                                <form action="{{route('like.store', $opinion)}}" method="POST" class="mx-1">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0">Like</button>
                                </form>
                            @else
                                <form action="{{route('like.destroy', $opinion)}}" method="POST" class="mx-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link p-0">Unlike</button>
                                </form>
                            @endif
                            <span>{{$opinion->likes->count()}} {{Str::plural('like', $opinion->likes->count())}}</span>
                        </div>
                    </div>
                    @endforeach
                    {{ $opiniones->links() }}
                @else
                    <p class="text-dark font-weight-bold">No hay opiniones</p>
                @endif
            </div>
        </div>
    </div>    
    
    @cannot('view', $pregunta)
        <div class="text-center pt-4">
            <a href={{ url('/'.Auth::user()->role->name.'/'.Auth::user()->id) }}>
                <button type="button" class="btn btn-danger">SALIR</button>
            </a>
        </div>
    @endcannot
</div>
{{-- FIN MENSAJES DE SUGERENCIA --}}

@endsection