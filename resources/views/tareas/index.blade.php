@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Tareas</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('tareas.create') }}" class="btn btn-primary mb-3">Crear Nueva Tarea</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de la Tarea</th>
                <th>Descripción</th>
                <th>Proyecto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->id }}</td>
                    <td>{{ $tarea->nombre_tarea }}</td>
                    <td>{{ $tarea->descripcion }}</td>
                    <td>{{ $tarea->proyecto->nombre }}</td>
                    <td>
                        <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    {{ $tareas->links() }}
</div>
@endsection
