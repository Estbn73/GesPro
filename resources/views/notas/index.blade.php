@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de {{ ucfirst($section) }}</h1>
    <a href="{{ route('proyectos.' . $section . '.create', $proyecto->id) }}" class="btn btn-success mb-3">Añadir Nuevo {{ ucfirst($section) }}</a>

    <ul class="list-group">
        @foreach ($items as $item)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ ucfirst($section) }}:</strong> {{ $item->descripcion }}<br>
                    <strong>Fecha:</strong> {{ $item->created_at }}
                </div>
                <div>
                    <a href="{{ route('proyectos.' . $section . '.edit', [$proyecto->id, $item->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('proyectos.' . $section . '.destroy', [$proyecto->id, $item->id]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
