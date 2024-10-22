@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Proyecto: {{ $proyecto->nombre }}</h1>

    <form action="{{ route('proyectos.update', $proyecto) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Campos similares a create.blade.php -->
        
        <!-- Agrega aquí los campos para editar el proyecto -->
        
        <button type="submit" class="btn btn-success">Actualizar Proyecto</button>
    </form>

    <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Volver a la lista</a>
</div>
@endsection