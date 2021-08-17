@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-info m-3 text-center" role="alert">
        <h4 class="alert-heading">¡Bienvenido/a a ORIS!</h4>
        <p class="mb-1">Parece que es la primera vez que utilizas nuestra plataforma.</p>
        <p>Antes de continuar, ¿podrías indicarnos si eres alumno/a o profesor/a?.</p>
        <a class="text-center btn btn-secondary"
            href="{{ url('/login/alumno/'. $user->name . '/' . $user->email . '/' . $user->id) }}"
            role="button">Alumno/a</a>
        <a class="text-center btn btn-secondary"
            href="{{ url('/send-mail-registro/' . $user->name . '/' . $user->email . '/' . $user->id) }}"
            role="button">Profesor/a</a>
        <hr>
        <a class="text-center btn btn-primary" href="{{ url('/') }}" role="button">Volver</a>
    </div>
</div>
@endsection