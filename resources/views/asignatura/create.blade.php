@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form action="{{ route('asignatura.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Nueva asignatura</h1>
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
                    <label for="subject_name" class="col-md-4 col-form-label">Nombre asignatura</label>

                    <input id="subject_name" type="text"
                        class="form-control @error('subject_name') is-invalid @enderror" name="subject_name"
                        value="{{ old('subject_name') }}" required autocomplete="subject_name" autofocus>

                    @error('subject_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="subject_id" class="col-md-4 col-form-label">Código de la asignatura</label>

                    <input id="subject_id" type="text" class="form-control @error('subject_id') is-invalid @enderror"
                        name="subject_id" value="{{ old('subject_id') }}" required autocomplete="subject_id" autofocus>

                    @error('subject_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
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