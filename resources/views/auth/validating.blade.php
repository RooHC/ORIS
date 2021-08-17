@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-success m-3 text-center" role="alert">
        <h4 class="alert-heading">Validación de tu cuenta</h4>
        <p>El administrador comprobará si realmente eres un profesor/a y se te enviará un correo de confirmación.</p>
        <hr>
        <a class="btn btn-primary" href="{{ url('/') }}" role="button">Volver</a>
    </div>
</div>
@endsection