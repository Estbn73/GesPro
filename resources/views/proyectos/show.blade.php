@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $proyecto->nombre }}</h1>
    <h3>{{ $proyecto->descripcion }}</h3>
    <p style="color: black;"><strong>Fecha de inicio:</strong> {{ $proyecto->fecha_inicio }}</p>
    <p style="color: black;"><strong>Fecha de finalización:</strong> {{ $proyecto->fecha_final }}</p>
    <p style="color: black;">
        <strong>Estado:</strong>
        @if($proyecto->estado == 1)
        <span class="badge bg-success">Activo</span>
        @else
        <span class="badge bg-danger">Inactivo</span>
        @endif
    </p>

    <!-- tarjeta Tareas -->
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tareas</h5>
                    <a href="{{ route('proyecto.tareas', ['proyecto' => $proyecto->id]) }}" class="btn btn-primary"> Ver Más</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Riesgos</h5>
                    <a href="{{ route('proyecto.riesgos', ['proyecto' => $proyecto->id]) }}" class="btn btn-primary"> Ver Más</a>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection

@section('scripts')
@livewireScripts
<script src="//unpkg.com/alpinejs" defer></script>
@endsection