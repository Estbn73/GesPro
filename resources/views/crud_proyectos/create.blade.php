@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Proyecto</h1>

    <form action="{{ route('proyectos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha Inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="fecha_final">Fecha Final</label>
            <input type="date" name="fecha_final" id="fecha_final" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label><br />
            <input type="checkbox" name="estado" id="estado"> Terminado
        </div>

        <button type="submit" class="btn btn-success">Guardar Proyecto</button>
    </form>

    <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Volver a la lista</a>
</div>
@endsection