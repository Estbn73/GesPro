@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tareas del Proyecto</h1>
    {{$id}}
    <livewire:proyecto-tareas-component :id="$id"></livewire:proyecto-tareas-component>
    
</div>
@endsection