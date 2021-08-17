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

<div class="container mb-5">
    @if(session('success'))
    <div class="alert alert-success m-5">
        {{ session('success') }}
    </div>
    @endif
    <!-- FAQ -->
    <div class="cabecera">
        <h2>FAQ</h2>
        <div class="separador"></div>
    </div>
    <div id="accordion-faq">
        <div class="card">
            <button class="card-header btn btn-link collapsed text-left font-weight-bold text-dark" id="headingOne"
                data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                FAQ 1
            </button>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion-faq">
                <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                    3
                    wolf
                    moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                    eiusmod.
                    Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                    assumenda
                    shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                    sapiente
                    ea
                    proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw
                    denim
                    aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
            </div>
        </div>
        <div class="card">
            <button class="card-header btn btn-link collapsed text-left font-weight-bold text-dark" id="headingTwo"
                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                FAQ 2
            </button>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion-faq">
                <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                    3
                    wolf
                    moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                    eiusmod.
                    Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                    assumenda
                    shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                    sapiente
                    ea
                    proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw
                    denim
                    aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
            </div>
        </div>
        <div class="card">
            <button class="card-header btn btn-link collapsed text-left font-weight-bold text-dark" id="headingThree"
                data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                FAQ 3
            </button>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion-faq">
                <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                    3
                    wolf
                    moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                    eiusmod.
                    Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                    assumenda
                    shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                    sapiente
                    ea
                    proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw
                    denim
                    aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT -->
    <section>
        <div class="cabecera">
            <h2>Formulario de contacto</h2>
            <div class="separador"></div>
        </div>
        <div class="card border-danger">
            <div class="card-body m-4">
                <form method="POST" action="{{ url('/contact') }}">
                    @csrf
                    <div class="md-form mb-2">
                        <label for="name" class="font-weight-bold">Nombre</label>
                        <input name="name" type="text" class="form-control" id="name" required>
                    </div>
                    <div class="md-form mb-2">
                        <label for="email" class="font-weight-bold">Email</label>
                        <input name="email" type="email" class="form-control" id="email" required>
                    </div>
                    <div class="md-form primary-textarea mb-4">
                        <label for="comment" class="font-weight-bold">Mensaje</label>
                        <textarea name="comment" id="comment" class="md-textarea form-control mb-0" rows="5"
                            style="padding-bottom: 1.2rem;" required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-oris btn-lg">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<!--Google map-->
<div class="map-container">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12051.850390406742!2d-5.6706833!3d40.9603982!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2809ba7ed4a44c2e!2sFacultad%20de%20Ciencias!5e0!3m2!1ses!2ses!4v1601194753621!5m2!1ses!2ses"
        frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
@endsection