<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="{{ asset('assets/crud_user.css') }}"> 
</head>
<body>

<h1>Crear Usuario</h1>

<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <label for="name">Nombre:</label>
    <input type="text" name="name" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Contraseña:</label>
    <input type="password" name="password" required>

    <label for="password_confirmation">Confirmar Contraseña:</label>
    <input type="password" name="password_confirmation" required>

    <label for="rol">Rol:</label>
    <select name="rol" required>
        <option value="admin">Administrador</option>
        <option value="user">Usuario</option>
    </select>

    <button type="submit">Crear Usuario</button>
</form>


</body>
</html>