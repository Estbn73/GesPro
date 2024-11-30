@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Documentos del Proyecto</h1>
    <h3>{{ $proyectoNombre }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb custom-breadcrumb">
            <li class="breadcrumb-item"><a href="/proyectos">Proyectos</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('proyectos.show', $proyectoId) }}">{{ $proyectoNombre }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Documentos</li>
        </ol>
    </nav>
    <livewire:proyecto-documentos-component :id="$id"></livewire:proyecto-documentos-component>
</div>
@endsection 