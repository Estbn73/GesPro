@extends('layouts.user')

@section('title', 'Calendario')

@section('content')
    <h1 class="text-center mb-4">Calendario de Tareas y Proyectos</h1>

    <!-- Contenedor para el calendario -->
    <div id="calendar"></div>

    <!-- Importar estilos y scripts de FullCalendar -->
    @vite(['resources/css/fullcalendar.css', 'resources/js/fullcalendar.js'])
@endsection
