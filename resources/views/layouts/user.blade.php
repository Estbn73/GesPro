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
                <li class="nav-item">
                    <a href="#home" class="nav-link">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="#services" class="nav-link">Servicios</a>
                </li>
                <li class="nav-item">
                    <a href="#contact" class="nav-link">Contacto</a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link" href="{{ route('logout') }}"
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
        <div class="main-content flex-grow-1 p-4" id="main-content">
            <button id="toggle-sidebar" class="btn btn-secondary mb-3">☰</button>
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleSidebar = document.getElementById('toggle-sidebar');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');

            toggleSidebar.addEventListener('click', () => {
                // Alternar clase "hidden" para mostrar/ocultar el sidebar
                sidebar.classList.toggle('hidden');
                
                // Ajustar el contenido principal según el estado del sidebar
                if (sidebar.classList.contains('hidden')) {
                    mainContent.style.marginLeft = '0';
                } else {
                    mainContent.style.marginLeft = '250px';
                }
            });
        });
    </script>
    @vite(['resources/js/app.js'])
    @livewireScripts
</body>
</html>
