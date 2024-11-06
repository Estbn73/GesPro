@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nueva Tarea</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Ups!</strong> Hubo algunos problemas con tu entrada.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tareas.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre_tarea">Nombre de la Tarea</label>
            <input type="text" name="nombre_tarea" class="form-control" id="nombre_tarea" value="{{ old('nombre_tarea') }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control" id="descripcion" rows="3" required>{{ old('descripcion') }}</textarea>
        </div>

        <div class="form-group">
            <label for="proyecto_id">Proyecto</label>
            <select name="proyecto_id" class="form-control" id="proyecto_id" required>
                <option value="">-- Selecciona un Proyecto --</option>
                @foreach($proyectos as $proyecto)
                    <option value="{{ $proyecto->id }}" {{ old('proyecto_id') == $proyecto->id ? 'selected' : '' }}>
                        {{ $proyecto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Guardar</button>
        <a href="{{ route('tareas.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
@endsection
