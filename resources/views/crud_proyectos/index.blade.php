@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Proyectos</h1>

    @if($proyectos->isEmpty())
        <div class="alert alert-warning">
            No hay proyectos disponibles. <a href="{{ route('proyectos.create') }}" class="btn btn-primary">Crear Nuevo Proyecto</a>
        </div>
    @else
        <a href="{{ route('proyectos.create') }}" class="btn btn-primary">Crear Nuevo Proyecto</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto->id }}</td>
                    <td>{{ $proyecto->nombre }}</td>
                    <td>{{ $proyecto->descripcion }}</td>
                    <td>{{ $proyecto->fecha_inicio }}</td>
                    <td>{{ $proyecto->fecha_final }}</td>
                    <td>{{ $proyecto->estado ? 'Terminado' : 'En Progreso' }}</td>
                    <td>
                        <a href="{{ route('proyectos.edit', $proyecto) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('proyectos.show', $proyecto->id) }}" class="btn btn-info btn-sm">Ver Tareas</a>
                        <form action="{{ route('proyectos.destroy', $proyecto) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este proyecto?');">
                            @CSRF
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $proyectos->links() }} <!-- Paginación -->
    @endif
</div>
@endsection
