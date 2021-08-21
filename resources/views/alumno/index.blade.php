@extends('layouts.app')

@section('content')
<div class="background-oris" id="area-personal">
    <div class="container pb-5 pt-3 text-center">
        <h1 class="text-white">{{ Auth::user()->name }}</h1>
        <h4 class="text-white pb-4">Área personal del alumno</h4>
    </div>
</div>
<div id="avatar-personal">
    <img src="{{ asset('images/avatar.png') }}" class="rounded-circle bg-second-oris">
</div>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<div class="container mb-5">
    <div class="text-center">
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @elseif(session()->has('fail'))
        <div class="alert alert-danger">
            {{ session()->get('fail') }}
        </div>
        @endif
    </div>
    <div class="row text-center">
        <div class="col-sm">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#subAsignatura">
                SUSCRIBIRSE A <br> UNA ASIGNATURA
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="subAsignatura" tabindex="-1" role="dialog" aria-labelledby="subAsignaturaLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="subAsignaturaLabel">Suscribirse a una asignatura</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('suscripcion.store') }}" method="POST">
                            @csrf
                            <div class="form-group w-75 mx-auto">
                                <input id="inputIDAsig" type="text" class="form-control form-control-lg text-center"
                                    name="inputIDAsig" placeholder="Código de la asignatura" required>
                            </div>
                            <button type="submit" class="btn btn-oris btn-lg">Suscribirme</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm">
            <a href="{{ url('/presentacion/create') }}">
                <button class="btn btn-primary">SUBIR <br> PRESENTACIÓN</button>
            </a>
        </div>

        <div class="col-sm">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#entrarReunion">
                ENTRAR A UNA <br> REUNIÓN
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="entrarReunion" tabindex="-1" role="dialog" aria-labelledby="entrarReunionLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="entrarReunionLabel">Entrar a una reunión</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('presentacion.search') }}" method="GET">
                            @csrf
                            <div class="form-group w-75 mx-auto">
                                <input id="inputIDSala" type="text" class="form-control form-control-lg text-center"
                                    name="inputIDSala" placeholder="ID de la reunión" required>
                            </div>
                            <button type="submit" class="btn btn-oris btn-lg">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section>
    <div class="container text-center">
        <h4 class="text-center font-weight-bold">MIS PRESENTACIONES</h4>
        <nav>
            <div class="nav nav-tabs justify-content-center" id="nav-tab-presentaciones" role="tablist">
                <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab"
                    aria-controls="nav-all" aria-selected="true">TODAS</a>
                <a class="nav-item nav-link" id="nav-completed-tab" data-toggle="tab" href="#nav-completed" role="tab"
                    aria-controls="nav-completed" aria-selected="false">COMPLETADAS</a>
                <a class="nav-item nav-link" id="nav-notcompleted-tab" data-toggle="tab" href="#nav-notcompleted"
                    role="tab" aria-controls="nav-notcompleted" aria-selected="false">NO COMPLETADAS</a>
            </div>
        </nav>
        <div class="album border-right border-left border-bottom bg-light p-4">
            <div class="tab-content" id="nav-tabContent">
                <form action="{{ url('/alumno/'.Auth::user()->id) }}" method="GET">
                    @csrf
                    <div class="row justify-content-md-center mb-3">
                        <div class="col-md-auto">
                            <select class="form-control" name="subject">
                                <option value="">Seleccionar una asignatura</option>
                                @foreach (Auth::user()->suscrito as $asignatura)
                                <option value="{{ $asignatura->id }}">
                                    {{ $asignatura->subject_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-auto">
                            <button class="btn btn-primary float-right" name='submitbutton' type="submit"
                                value="filtrar">Filtrar</button>
                        </div>
                        <div class="col-md-auto">
                            <button class="btn btn-danger float-right" name='submitbutton' type="submit"
                                value="limpiar">Limpiar</button>
                        </div>
                    </div>
                </form>

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
                                        @if(!$presentacion->completed)
                                        <div class="btn-group">
                                            <a href="{{ url('/presentacion/'.$presentacion->id.'/edit') }}">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-secondary">Editar</button>
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <a href="{{ url('/presentacion/delete/'.$presentacion->id) }}">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-secondary">Eliminar</button>
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{ $presentaciones->links() }}
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-completed" role="tabpanel" aria-labelledby="nav-completed-tab">
                    <div class="row">
                        @foreach ($presentaciones as $presentacion)
                        @if ($presentacion->completed == 1)
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
                        @endif
                        @endforeach
                        {{ $presentaciones->links() }}
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-notcompleted" role="tabpanel" aria-labelledby="nav-notcompleted-tab">
                    <div class="row">
                        @foreach ($presentaciones as $presentacion)
                        @if ($presentacion->completed == 0)
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
                                        @if(!$presentacion->completed)
                                        <div class="btn-group">
                                            <a href="{{ url('/presentacion/'.$presentacion->id.'/edit') }}">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-secondary">Editar</button>
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <a href="{{ url('/presentacion/delete/'.$presentacion->id) }}">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-secondary">Eliminar</button>
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        {{ $presentaciones->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection