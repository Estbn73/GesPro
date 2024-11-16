<div>
    <h4>{{ $proyecto->nombre }}</h4>
    <p><strong>Descripción:</strong> {{ $proyecto->descripcion }}</p>
    <p><strong>Estado:</strong> {{ $proyecto->estado == 1 ? 'Activo' : 'Inactivo' }}</p>
    <p><strong>Fecha Inicio:</strong> {{ $proyecto->fecha_inicio }}</p>
    <p><strong>Fecha Final:</strong> {{ $proyecto->fecha_final }}</p>

    <hr>
    <h5>Tareas Pendientes</h5>
    <div wire:loading>
        <p>Cargando tareas...</p>
    </div>
    <div wire:loading.remove>
        @if(count($tareas) > 0)
            <ul class="list-group">
                @foreach($tareas as $tarea)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $tarea->nombre_tarea }}</strong>: {{ $tarea->descripcion }}
                        </div>
                        <div>
                            <input 
                                type="checkbox" 
                                wire:click="toggleEstado({{ $tarea->id }})" 
                                {{ $tarea->estado ? 'checked' : '' }}
                            >
                            <span class="badge bg-{{ $tarea->estado ? 'success' : 'secondary' }}">
                                {{ $tarea->estado ? 'Completada' : 'Pendiente' }}
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No hay tareas asignadas a este proyecto.</p>
        @endif
    </div>
</div>
