@extends('layouts.app')

@section('content')

<div class = "conteiner">
<h2>Gestión de Usuarios</h2>
<a href="{{ route('users.create') }}" class="btn btn-primary">Crear Nuevo Usuario</a>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<table class ="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->rol }}</td> 
                <td>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning" >Editar</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" >Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No hay usuarios registrados.</td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>



@endsection