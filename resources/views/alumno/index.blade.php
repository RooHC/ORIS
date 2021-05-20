@extends('layouts.app')

@section('content')
<div class="background-oris" id="area-personal">
    <div class="container pb-5 pt-3 text-center">
        <h1 class="text-white">{{ $user->name }}</h1>
        <h4 class="text-white pb-4">Área personal del alumno</h4>
    </div>
</div>
<div id="avatar-personal">
    <img src="{{ asset('images/avatar.png') }}" class="rounded-circle bg-second-oris">
</div>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<div class="text-center w-25 mx-auto mb-4">
    <h4 class="text-center font-weight-bold">ENTRAR A UNA REUNIÓN</h4>
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @elseif(session()->has('fail'))
    <div class="alert alert-danger">
        {{ session()->get('fail') }}
    </div>
    @endif
    <form action="{{ route('presentacion.search') }}" method="GET">
        @csrf
        <div class="form-group w-75 mx-auto">
            <input id="inputIDSala" type="text" class="form-control form-control-lg text-center" name="inputIDSala"
                placeholder="ID de la reunión" required>
        </div>
        <button type="submit" class="btn btn-oris btn-lg">Entrar</button>
    </form>
</div>
<section>
    <div class="container text-center">
        <h4 class="text-center font-weight-bold">MIS PRESENTACIONES</h4>
        <div class="d-flex justify-content-center m-4">
            <a href="{{ url('/presentacion/create') }}">
                <button class="btn btn-primary">SUBIR <br> PRESENTACIÓN</button>
            </a>
        </div>
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