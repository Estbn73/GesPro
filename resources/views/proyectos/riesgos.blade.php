@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Riesgos del Proyecto</h1>
    <h3>{{ $proyectoNombre }}</h3>
    <livewire:proyecto-riesgos-component :id="$id"></livewire:proyecto-riesgos-component>
</div>
@endsection

