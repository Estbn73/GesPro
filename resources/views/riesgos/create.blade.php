@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Añadir Nuevo Riesgo</h2>
    <form action="{{ route('proyectos.riesgos.store', $proyecto->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" name="tipo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="impacto" class="form-label">Impacto</label>
            <input type="number" name="impacto" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
