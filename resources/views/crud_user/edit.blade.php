
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario: {{ $user->name }}</title>
    <link rel="stylesheet" href="{{ asset('assets/crud_user.css') }}"> 
</head>
<body>

<h1>Editar Usuario: {{ $user->name }}</h1>

<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')
    
    <label for="name">Nombre:</label>
    <input type="text" name="name" value="{{ $user->name }}" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ $user->email }}" required>

    <label for="rol">Rol:</label>
    <select name="rol" required>
        <option value="admin" {{ $user->rol == 'admin' ? 'selected' : '' }}>Administrador</option>
        <option value="user" {{ $user->rol == 'user' ? 'selected' : '' }}>Usuario</option>
    </select>

    <button type="submit">Actualizar Usuario</button>
</form>

</body>
</html>