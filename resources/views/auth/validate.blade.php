@extends('layouts.app')

@section('content')
<div class="container">
    @if($success)
    <div class="alert alert-success m-3 text-center" role="alert">
        <h4 class="alert-heading">Validación del usuario</h4>
        <p>El usuario ha sido validado como profesor/a y se le ha enviado un correo de confirmación.</p>
        <hr>
        <a class="btn btn-primary" href="{{ url('/') }}" role="button">Volver</a>
    </div>
    @else
    <div class="alert alert-danger m-3 text-center" role="alert">
        <h4 class="alert-heading">Validación del usuario</h4>
        <p>El usuario NO ha sido validado como profesor/a y se le ha enviado un correo comunicándoselo.</p>
        <hr>
        <a class="btn btn-primary" href="{{ url('/') }}" role="button">Volver</a>
    </div>
    @endif
</div>
@endsection