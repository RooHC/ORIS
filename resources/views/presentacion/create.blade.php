@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form action="{{ route('presentacion.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Nueva presentación</h1>
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
                        value="{{ old('title') }}" required autocomplete="title" autofocus>

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="subject" class="col-md-4 col-form-label">Asignatura</label>

                    <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror"
                        name="subject" value="{{ old('subject') }}" required autocomplete="subject" autofocus>

                    @error('subject')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row pt-3">
                    <label for="file" class="col-md-4 col-form-label">Archivo *</label>

                    <input type="file" , class="form-control-file @error('file') is-invalid @enderror" id="file"
                        name="file" value="{{ old('file') }}" required autocomplete="file" autofocus>

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