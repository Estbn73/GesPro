@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Presupuesto</h2>
    <form action="{{ route('proyectos.presupuesto.update', [$proyecto->id, $presupuesto->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" class="form-control" value="{{ $presupuesto->descripcion }}" required>
        </div>
        <div class="mb-3">
            <label for="monto" class="form-label">Monto</label>
            <input type="number" name="monto" class="form-control" value="{{ $presupuesto->monto }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection
