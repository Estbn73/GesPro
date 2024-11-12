@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Riesgo</h2>
    <form action="{{ route('proyectos.riesgos.update', [$proyecto->id, $riesgo->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" name="tipo" class="form-control" value="{{ $riesgo->tipo }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3" required>{{ $riesgo->descripcion }}</textarea>
        </div>
        <div class="mb-3">
            <label for="impacto" class="form-label">Impacto</label>
            <input type="number" name="impacto" class="form-control" value="{{ $riesgo->impacto }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection
