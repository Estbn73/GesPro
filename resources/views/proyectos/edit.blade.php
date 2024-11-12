@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Proyecto: {{ $proyecto->nombre }}</h1>

    <form action="{{ route('proyectos.update', $proyecto) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $proyecto->nombre }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" required>{{ $proyecto->descripcion }}</textarea>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha Inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ $proyecto->fecha_inicio }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_final">Fecha Final</label>
            <input type="date" name="fecha_final" id="fecha_final" class="form-control" value="{{ $proyecto->fecha_final }}" required>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label><br />
            <input type="checkbox" name="estado" id="estado" {{ $proyecto->estado ? 'checked' : '' }}> Terminado
        </div>

        <button type="submit" class="btn btn-success">Actualizar Proyecto</button>
    </form>

    <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Volver a la lista</a>
</div>
@endsection