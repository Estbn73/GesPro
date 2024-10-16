<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Administrador</title>
    <link rel="stylesheet" href="{{ asset('assets/user.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/crud_user.css') }}"> 
</head>
<body>

    <button class="menu-btn" id="menu-btn">☰</button>

    <div class="sidebar" id="sidebar">
        <a href="#home">Inicio</a>
        <a href="#" id="manage-users">Gestión de Usuarios</a> 
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

    <script src="{{ asset('assets/crud_user.js') }}"></script> 
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        menuBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('active');
            menuBtn.classList.toggle('active');
        });

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
    </script>

</body>
</html>