<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gespro</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @livewireStyles
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light text-secondary">
    <div id="app" class="d-flex">
        <!-- Sidebar con toggle -->
        @auth
        <div class="sidebar bg-primary text-white p-3" id="sidebar" style="width: 250px; min-height: 100vh;">
            <h2>GesPro</h2>
            <ul class="nav flex-column">
                
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link text-white">Gestión de Usuarios</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('proyectos.index') }}" class="nav-link text-white">Gestión de Proyectos</a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link text-white" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        @endauth

        <!-- Contenido Principal -->
        <div class="main-content flex-grow-1 p-4">
            <button id="toggle-sidebar" class="btn btn-secondary mb-3">☰</button>
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    @yield('scripts') <!-- Incluir cualquier otro script adicional -->
    @livewireScripts <!-- Incluir scripts de Livewire -->
</body>
</html>
