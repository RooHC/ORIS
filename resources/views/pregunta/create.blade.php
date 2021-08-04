@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form action="{{ route('pregunta.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Nueva pregunta</h1>
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
                    <label for="question" class="col-md-4 col-form-label">Pregunta</label>

                    <input id="question" type="text" class="form-control @error('question') is-invalid @enderror"
                        name="question" value="{{ old('question') }}" required autocomplete="question" autofocus>

                    @error('question')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="option_A" class="col-md-4 col-form-label">Opcion A</label>

                    <input id="option_A" type="text" class="form-control @error('option_A') is-invalid @enderror"
                        name="option_A" value="{{ old('option_A') }}" required autocomplete="option_A" autofocus>

                    @error('option_A')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="option_B" class="col-md-4 col-form-label">Opcion B</label>

                    <input id="option_B" type="text" class="form-control @error('option_B') is-invalid @enderror"
                        name="option_B" value="{{ old('option_B') }}" required autocomplete="option_B" autofocus>

                    @error('option_B')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="option_C" class="col-md-4 col-form-label">Opcion C</label>

                    <input id="option_C" type="text" class="form-control @error('option_C') is-invalid @enderror"
                        name="option_C" value="{{ old('option_C') }}" required autocomplete="option_C" autofocus>

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

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="solution" name="solution" value="option_A">
                        <label class="form-check-label" for="solution">A</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="solution" name="solution" value="option_B"
                            required>
                        <label class="form-check-label" for="solution">B</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="solution" name="solution" value="option_C">
                        <label class="form-check-label" for="solution">C</label>
                    </div>
                </div>

                <input name="presentacion_id" type="hidden" value="{{$presentacion->id}}">

                <div class="row pt-4">
                    <div class="col-6">
                        <button class="btn btn-primary" type="submit" name="finalizar">Finalizar</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary float-right" type="submit" name="nueva_pregunta">Añadir otra
                            pregunta</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection