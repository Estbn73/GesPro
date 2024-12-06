@extends('layouts.user')

@section('title', 'Calendario')

@section('content')
    <h1 class="text-center mb-4">Calendario de Tareas y Proyectos</h1>

    <!-- Leyenda de Prioridades -->
    <div class="d-flex justify-content-center align-items-center mb-4">
        <div class="d-flex align-items-center me-4">
            <span class="circle me-2 bg-danger"></span>
            <span class="fw-bold">Prioridad Alta</span>
        </div>
        <div class="d-flex align-items-center me-4">
            <span class="circle me-2 bg-warning"></span>
            <span class="fw-bold">Prioridad Media</span>
        </div>
        <div class="d-flex align-items-center">
            <span class="circle me-2 bg-success"></span>
            <span class="fw-bold">Prioridad Baja</span>
        </div>
    </div>

    <!-- Contenedor para el calendario -->
    <div id="calendar"></div>

    <!-- Pasar la URL dinámica al script -->
    <script>
        const eventosUrl = "{{ route('eventos.obtener') }}";
    </script>

    <!-- Importar estilos y scripts de FullCalendar -->
    @vite(['resources/css/fullcalendar.css', 'resources/js/fullcalendar.js'])
@endsection
