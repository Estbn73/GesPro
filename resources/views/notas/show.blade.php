@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de {{ ucfirst($section) }}</h1>
    <p><strong>Descripción:</strong> {{ $item->descripcion }}</p>
    <p><strong>Fecha de Creación:</strong> {{ $item->created_at }}</p>
    <!-- Puedes agregar más detalles según sea necesario -->
    <a href="{{ route('proyectos.' . $section . '.index', $proyecto->id) }}" class="btn btn-primary">Volver a la lista</a>
</div>
@endsection
