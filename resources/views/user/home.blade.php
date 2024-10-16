<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz Minimalista con Menú Deslizante</title>
    <link rel="stylesheet" href="{{asset('assets/user.css')}}"> 
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
        <h1>Bienvenido, {{ Auth::user()->name }}!</h1>

        <h2>Proyectos actuales</h2>
        <ul class="project-list">
            <li class="project-item">
                <h2>Proyecto 1: Aplicación de escritorio</h2>
                <p>Funcionalidad que permite descargar y subir archivos a la base de datos.</p>
            </li>
            <li class="project-item">
                <h2>Proyecto 2: Panel de administración</h2>
                <p>Desarrollo del panel de administración con control de usuarios y roles.</p>
            </li>
            <li class="project-item">
                <h2>Proyecto 3: Autenticación en Django</h2>
                <p>Implementación de un sistema de login para usuarios tipo monitor con acceso a correos de Google.</p>
            </li>
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
