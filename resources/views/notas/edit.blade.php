@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Nota</h2>
    <form action="{{ route('proyectos.notas.update', [$proyecto->id, $nota->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ $nota->titulo }}" required>
        </div>
        <div class="mb-3">
            <label for="contenido" class="form-label">Contenido</label>
            <textarea name="contenido" class="form-control" rows="3" required>{{ $nota->contenido }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection
