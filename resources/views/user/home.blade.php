<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz Minimalista con Menú Deslizante</title>
    <link rel="stylesheet" href="{{ asset('assets/user.css') }}"> 
</head>
<body>

    <button class="menu-btn" id="menu-btn">☰</button>

    <div class="sidebar" id="sidebar">
        <a href="#home">Inicio</a>
        <a href="#services">Servicios</a>
        <a href="#contact">Contacto</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Cerrar sesión
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <div class="main-content" id="main-content">
        <h1>Bienvenido, {{ $user->name }}!</h1>

        <h2>Proyectos actuales</h2>
<ul class="project-list">
    @if(isset($proyectos) && count($proyectos) > 0)
        @foreach($proyectos as $proyecto)
            <li class="project-item">
                <h2>{{ $proyecto->nombre }}</h2>
                <p>{{ $proyecto->descripcion }}</p>
            </li>
        @endforeach
    @else
        <li>No tienes proyectos asignados.</li>
    @endif
</ul>
    </div>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        menuBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('active');
            menuBtn.classList.toggle('active');
        });
    </script>

</body>
</html>