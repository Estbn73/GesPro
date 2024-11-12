@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Añadir Nuevo Presupuesto</h2>
    <form action="{{ route('proyectos.presupuesto.store', $proyecto->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="monto" class="form-label">Monto</label>
            <input type="number" name="monto" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
