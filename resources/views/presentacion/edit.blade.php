@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <form action="{{ url('/presentacion/'.$presentacion->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Editar presentación</h1>
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

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label">Título presentación</label>

                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        value="{{ old('title') ?? $presentacion->title }}" autocomplete="title" autofocus>

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row pt-3">
                    <label for="file" class="col-md-4 col-form-label">Archivo *</label>
                    <div class="w-100 ml-5 mb-2">
                        <a href="{{ url('storage/' . $presentacion->file) }}" target="_blank">
                            <i class="fa fa-file-text fa-3x color-oris"></i>
                        </a>
                    </div>

                    <input type="file" , class="form-control-file @error('file') is-invalid @enderror" id="file"
                        name="file" value="{{ old('file') ?? $presentacion->file }}" autocomplete="file" autofocus>

                    @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <p class="pt-3"><small>* El formato del archivo ha de ser PDF. Si necesitas ayuda consulta nuestro
                            <a href="{{ url('/contacto') }}">FAQ</a>.</small></p>
                </div>

                <div class="row pt-4">
                    <div class="col-6">
                        <a href={{ url('/'.Auth::user()->role->name.'/'.Auth::user()->id) }}>
                            <button class="btn btn-primary" type="button">Cancelar</button>
                        </a>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary float-right" type="submit">Siguiente</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

@endsection