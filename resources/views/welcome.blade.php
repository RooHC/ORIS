@extends('layouts.app')
@section('content')
<nav class="navbar navbar-expand-lg p-0">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="navbar-nav nav-fill w-50 mx-auto">
            <a class="nav-link" href="#">Studium</a>
            <a class="nav-link" href="#">MiUsal</a>
            <a class="nav-link" href="#">Alumni</a>
            <a class="nav-link" href="#">Soporte</a>
        </div>
    </div>
</nav>
<header class="masthead">
    <div class="container-lg h-100">
        <div class="row h-100 align-items-center">
            <div class="col-sm-8 text-center">
                <h1 class="text-white" style="line-height: 54px">Oris, una innovadora forma de evaluar exposiciones
                    orales en clase de la Universidad de Salamanca</h1>
            </div>
            <div class="col-sm-4 text-center">
                <h1 class="text-white">Entrar a una reunión</h1>
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
                        <input id="inputIDSala" type="text" class="form-control form-control-lg text-center"
                            name="inputIDSala" placeholder="ID de la reunión" required>
                    </div>
                    <button type="submit" class="btn btn-oris btn-lg">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</header>
<section>
    <div class="container py-5" id="porque-oris">
        <h2 class="color-oris text-center font-weight-bold mb-lg-5 mt-2">¿Por qué Oris?</h2>
        <div class="row">
            <div class="col-sm-3">
                <div class="d-flex justify-content-center mb-3">
                    <img src="{{ asset('images/icon_1.png') }}">
                </div>
                <p class="text-center">Una <span class="color-oris">innovadora</span> forma de evaluar exposiciones
                    orales</p>
            </div>
            <div class="col-sm-3">
                <div class="d-flex justify-content-center mb-3">
                    <img src="{{ asset('images/icon_2.png') }}">
                </div>
                <p class="text-center">Un diseño <span class="color-oris">seguro</span> para trabajar de manera
                    confiable</p>
            </div>
            <div class="col-sm-3">
                <div class="d-flex justify-content-center mb-3">
                    <img src="{{ asset('images/icon_3.png') }}">
                </div>
                <p class="text-center">Mejores <span class="color-oris">resultados</span> académicos y un aumento de
                    atención por parte del
                    alumnado</p>
            </div>
            <div class="col-sm-3">
                <div class="d-flex justify-content-center mb-3">
                    <img src="{{ asset('images/icon_4.png') }}">
                </div>
                <p class="text-center">Una experiencia <span class="color-oris">sencilla</span> y muy intuitiva</p>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container-fluid background-oris text-white p-5" id="duda-consulta">
        <h2 class="text-center font-weight-bold mb-lg-4 mt-2">¿Tienes alguna duda o consulta?</h2>
        <div class="row">
            <div class="col text-center">
                <a class="btn btn-oris btn-lg" href="{{ url('/contacto') }}" role="button">CONTACTO</a>
            </div>
        </div>
    </div>
</section>
@endsection