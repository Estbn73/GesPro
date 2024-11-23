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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->
    @livewireStyles
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body class="bg-light text-secondary">
    <div id="app" class="d-flex">
        <!-- Sidebar con toggle -->
        @auth
        <div class="sidebar">
            <h2 class="p-3" style="color: white;">GesPro</h2>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
                        Gestión de Usuarios
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('proyectos.index') }}" class="nav-link {{ request()->routeIs('proyectos.index') ? 'active' : '' }}">
                        Gestión de Proyectos
                    </a>
                </li>
            </ul>
            <div class="logout-link">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        @endauth

        <!-- Contenido Principal -->
        <div class="main-content flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    @yield('scripts')
    @livewireScripts

</body>

</html>