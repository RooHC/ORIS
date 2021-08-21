@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row offset-2">
        <h1>Editar questionario</h1>
    </div>

    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @elseif(session()->has('fail'))
    <div class="alert alert-danger">
        {{ session()->get('fail') }}
    </div>
    @endif

    @foreach ($presentacion->preguntas as $pregunta)
    <form action="{{ url('/pregunta/'.$pregunta->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <hr>
                <div class="row">
                    <h3>Pregunta 1</h3>
                </div>

                <div class="form-group row">
                    <label for="question" class="col-md-4 col-form-label">Pregunta</label>

                    <input id="question" type="text" class="form-control @error('question') is-invalid @enderror"
                        name="question" value="{{ old('question') ?? $pregunta->question }}" autocomplete="question"
                        autofocus>
                    @error('question')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="option_A" class="col-md-4 col-form-label">Opcion A</label>

                    <input id="option_A" type="text" class="form-control @error('option_A') is-invalid @enderror"
                        name="option_A" value="{{ old('option_A') ?? $pregunta->option_A }}" autocomplete="option_A"
                        autofocus>
                    @error('option_A')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="option_B" class="col-md-4 col-form-label">Opcion B</label>

                    <input id="option_B" type="text" class="form-control @error('option_B') is-invalid @enderror"
                        name="option_B" value="{{ old('option_B') ?? $pregunta->option_B }}" autocomplete="option_B"
                        autofocus>
                    @error('option_B')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="option_C" class="col-md-4 col-form-label">Opcion C</label>

                    <input id="option_C" type="text" class="form-control @error('option_C') is-invalid @enderror"
                        name="option_C" value="{{ old('option_C') ?? $pregunta->option_C }}" autocomplete="option_C"
                        autofocus>
                    @error('option_C')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <div class="w-100">
                        <label for="solution" class="col-md-4 col-form-label">Solución</label>
                    </div>
                    <?php 
                    $checked_A="";
                    $checked_B="";
                    $checked_C="";
                    ?>
                    @if($pregunta->solution == "option_A")
                    <?php $checked_A="checked"?>
                    @elseif($pregunta->solution == "option_B")
                    <?php $checked_B="checked"?>
                    @elseif($pregunta->solution == "option_C")
                    <?php $checked_C="checked"?>
                    @endif
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="solution" name="solution" value="option_A"
                            {{$checked_A}}>
                        <label class="form-check-label" for="solution">A</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="solution" name="solution" value="option_B"
                            {{$checked_B}}>
                        <label class="form-check-label" for="solution">B</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="solution" name="solution" value="option_C"
                            {{$checked_C}}>
                        <label class="form-check-label" for="solution">C</label>
                    </div>
                </div>

                <div class="row">
                    <div class="w-100">
                        <a class="btn btn-primary float-left" href="{{ url('/pregunta/delete/' . $pregunta->id) }}"
                            role="button">Eliminar pregunta</a>
                        <button class="btn btn-primary float-right" type="submit">Actualizar</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
    @endforeach
    <div class="row">
        <div class="col-8 offset-2 text-center">
            <br>
            <a class="btn btn-primary" href="{{ url('/pregunta/create/' . $presentacion->id) }}" role="button">Añadir
                pregunta</a>
            <hr>
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#finalizar">Finalizar</button>
            <div class="modal fade" id="finalizar" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">¿Desea finalizar?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Si no has pulsado el boton de actualizar, tus preguntas no serán actualizadas.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <a href={{ url('/'.Auth::user()->role->name.'/'.Auth::user()->id) }}>
                                <button type="button" class="btn btn-primary">Finalizar</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection