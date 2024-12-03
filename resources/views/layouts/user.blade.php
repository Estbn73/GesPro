<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Usuario - GesPro')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


    <!-- Styles -->
    @livewireStyles
    @vite(['resources/sass/user.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app" class="d-flex">
        <!-- Sidebar -->
        @auth
        <div class="sidebar" id="sidebar">
            <h2>GesPro</h2>
            <ul class="nav flex-column">
                <!-- Icono de Inicio -->
                <li class="nav-item">
                    <a href="{{ route('user.home') }}" class="nav-link">
                        <i class="fas fa-home me-2"></i>Inicio
                    </a>
                </li>

                <!-- Icono de Miembros -->
                <li class="nav-item">
                    <a href="{{ route('user.miembros') }}" class="nav-link">
                        <i class="fas fa-users me-2"></i>Miembros
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.calendario') }}" class="nav-link">
                        <i class="fas fa-calendar-alt me-2"></i>Calendario
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>


        @endauth

        <!-- Contenido Principal -->
        <div class="main-content flex-grow-1 p-4" id="main-content">
            <button id="toggle-sidebar" class="btn btn-secondary mb-3">☰</button>
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    @livewireScripts
</body>
</html>
