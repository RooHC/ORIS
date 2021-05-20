<!doctype html>
<html lang="es-ES">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Bienvenido a Oris - USAL, un sistema de evaluación de exposiciones orales de la Universidad de Salamanca." />

    <!-- FAVICONS ICON -->
    <link rel="icon" href={{ asset('images/favicon.ico') }} type="image/x-icon" />
    <link rel="shortcut icon" href={{ asset('images/favicon.png') }} type="image/x-icon" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Oris') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/scripts.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,400italic,600italic" rel="stylesheet"
        type="text/css">

    <!-- Font-Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app-presentacion">
        <nav class="navbar navbar-expand-md navbar-light bg-nav shadow-sm p-0">
            <div class="container">
                <a class="navbar-brand p-0" href="{{ url('/') }}" title="Oris - Universidad de Salamanca">
                    <img src="{{ asset('images/title2.png') }}" alt="Oris - Universidad de Salamanca" class="mw-100 my-2 avatar">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="text-center text-white w-100">
                    <h2 class="mb-0"><strong>{{ $presentacion->title }}</strong></h2>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="btn btn-oris" href="{{ route('login') }}" role="button">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="btn btn-oris" href="{{ route('register') }}"
                                role="button">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ asset('images/avatar2black.png') }}" width="40" height="40" class="rounded-circle">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href={{ url('/'.Auth::user()->role->name.'/'.Auth::user()->id) }}>
                                    {{Auth::user()->name}}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            @yield('content')
        </main>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mx-auto text-center p-4">
                        <img src="{{ asset('images/oris_logHeader.png') }}" class="mw-100">
                    </div>
                </div>
            </div>
            <div class="container-fluid background-oris text-white text-center">
                <p><small>© ORIS | UNIVERSIDAD DE SALAMANCA</small></p>
            </div>
        </footer>
    </div>
</body>

</html>