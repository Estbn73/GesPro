@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Presupuesto del Proyecto</h1>
    <h3>{{ $proyectoNombre }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb custom-breadcrumb">
            <li class="breadcrumb-item"><a href="/proyectos">Proyectos</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('proyectos.show', $proyectoId) }}">{{ $proyectoNombre }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Presupuestos</li>
        </ol>
    </nav>
    <livewire:proyecto-presupuestos2-component :id="$id"></livewire:proyecto-presupuestos2-component>
</div>
@endsection