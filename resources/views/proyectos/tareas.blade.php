@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Tareas del Proyecto</h1>
    <h3>{{ $proyectoNombre }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb custom-breadcrumb">
            <li class="breadcrumb-item"><a href="/proyectos">Proyectos</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('proyectos.show', $proyectoId) }}">{{ $proyectoNombre }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tareas</li>
        </ol>
    </nav>
    <livewire:proyecto-tareas-component :id="$id"></livewire:proyecto-tareas-component>
</div>
@endsection


