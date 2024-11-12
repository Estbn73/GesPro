@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Proyectos</h1>
    <div class="row">
        @foreach($proyectos as $proyecto)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $proyecto->nombre }}</h5>
                        <p class="card-text">{{ Str::limit($proyecto->descripcion, 100) }}</p>
                        <p class="card-text"><strong>Fecha Inicio:</strong> {{ $proyecto->fecha_inicio }}</p>
                        <p class="card-text"><strong>Fecha Final:</strong> {{ $proyecto->fecha_final }}</p>
                        <p class="card-text"><strong>Estado:</strong> {{ $proyecto->estado }}</p>
                        <a href="{{ route('proyectos.show', $proyecto) }}" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
