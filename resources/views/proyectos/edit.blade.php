@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Editar Proyecto: {{ $proyecto->nombre }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('proyectos.update', $proyecto) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Proyecto:</label>
                            <input type="text" class="form-control" name="nombre" value="{{ $proyecto->nombre }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea class="form-control" name="descripcion" rows="3" required>{{ $proyecto->descripcion }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
                            <input type="date" class="form-control" name="fecha_inicio" value="{{ $proyecto->fecha_inicio }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_fin" class="form-label">Fecha Final:</label>
                            <input type="date" class="form-control" name="fecha_fin" value="{{ $proyecto->fecha_final }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado:</label>
                            <select name="estado" class="form-select" required>
                                <option value="1" {{ $proyecto->estado == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ $proyecto->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" onclick="history.back();">
                                <i class="fas fa-arrow-left"></i> Volver
                            </button>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
