<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Ckeditor -->
    @yield('ck-editor-CDN')
    @yield('cssDataTable')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="/sgd_upec/public/css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
    @yield('cssSelect2')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-black shadow-sm" style="background-color: #000;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/sgd_upec/public/images/UPEC.png" alt="logo" class="img-fluid" style="max-height: 84px;">
        </a>
        <div class="container-fluid d-flex flex-column align-items-center">
            <!-- Fondo negro para todo el encabezado -->
            <span class="navbar-text text-white font-weight-bold display-6">
                Universidad Politécnica Estatal del Carchi
            </span>
            <span class="navbar-text text-white font-weight-bold text-uppercase" style="font-size: 1.2rem;">
                SECRETARÍA GENERAL
            </span>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @guest
                    <!-- Authentication Links -->
                @else
                    @php
                        $position = \DB::table('positions')->where('id', '=', Auth::user()->position_id)->first();
                        $departament = \DB::table('departaments')->where('id', '=', Auth::user()->departament_id)->first();
                        $roles = array("Super Administrador", "Administrador", "Jefe de Departamento", "Funcionario");
                    @endphp
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->lastname }} {{ Auth::user()->name }}
                            
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li class="dropdown-item text-center">
                                <small class="text-muted">{{ $position->name }}</small><br>
                                <small class="text-muted">Departamento: {{$departament->name}}</small><br>
                                <small class="text-muted">Rol: {{ $roles[Auth::user()->rol + 1] }}</small>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('MiPerfil.edit', ['id' => Auth::user()->id]) }}">Perfil</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li>
               
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row  flex-column flex-md-row">
        @include('includes.menu')
        <main class="col bg-light py-3 px-4 flex-grow-1">
            @yield('content')
        </main>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
@yield('jsSelect2')
@yield('ck-editor')
@yield('jsDataTable')

<!-- Añade este estilo a tu código -->
<style>
    body {
        background-color: #f8f9fa;
    }
    .navbar-dark .navbar-nav .nav-link {
        color: white;
    }
    .navbar-dark .navbar-nav .nav-link:hover {
        color: #d4d4d4;
    }
    .display-6 {
        font-size: 1.5rem; /* Tamaño de fuente */
        font-weight: bold; /* Negrita */
    }
    .text-uppercase {
        font-size: 1.2rem; /* Tamaño de fuente para SECRETARÍA GENERAL */
    }
    .navbar-text {
        text-align: center; /* Asegura que el texto esté centrado */
    }
    .bg-black {
        background-color: #000 !important; /* Fondo negro */
    }

    /* Estilos para el menú dropdown */
    .dropdown-menu .dropdown-item {
        color: white !important;
    }

    /* Estilos para los textos pequeños dentro del dropdown */
    .dropdown-menu small {
        color: white !important; /* Hace que el texto sea blanco */
    }

    /* Opcional: Mejora de color cuando se pasa el cursor sobre un elemento */
    .dropdown-item:hover {
        background-color: #00796b !important;
    }

    /* Cambia el color de fondo del dropdown */
    .dropdown-menu {
        background-color: #343a40 !important;
    }
</style>

</body>
</html>
