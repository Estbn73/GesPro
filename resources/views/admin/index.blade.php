<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Administrador</title>
    <link rel="stylesheet" href="{{ asset('assets/user.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user.css') }}"> 
</head>
<body>

    <button class="menu-btn" id="menu-btn">☰</button>

    <div class="sidebar" id="sidebar">
    <a href="#home">Inicio</a>
    <a href="#" id="manage-users">Gestión de Usuarios</a>
    <a href="#" id="manage-projects">Gestión de Proyectos</a> <!-- Nueva opción -->
    <a href="#settings">Configuraciones</a>
    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Cerrar sesión
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>

    <div class="main-content" id="main-content">
        <h1>Bienvenido, Administrador!</h1>
        <div id="user-management-container">
        </div>
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
        //FUNCION DE CRUD DE USUARIOS
        document.getElementById('manage-users').addEventListener('click', function() {
            loadUserManagement();
        });

        function loadUserManagement() {
            fetch('{{ route("users.index") }}') 
                .then(response => response.text())
                .then(html => {
                    document.getElementById('user-management-container').innerHTML = html; 
                })
                .catch(error => console.error('Error loading user management:', error));
        }

        //FUNCION DE CRUD DE PROYECTOS
        document.getElementById('manage-projects').addEventListener('click', function() {
         loadProjectManagement();
        });

        function loadProjectManagement() {
        console.log('Fetching URL:', '{{ route("proyectos.index") }}');

        fetch('{{ route("proyectos.index") }}')
    .then(response => {
        if (!response.ok) {
            console.error('Error status:', response.status);
            throw new Error('Error al cargar la vista de proyectos');
        }
        return response.text();
    })
    .then(html => {
        document.getElementById('user-management-container').innerHTML = html;
    })
    .catch(error => {
        console.error('Error al cargar la gestión de proyectos:', error);
    });


}
    </script>

</body>
</html>