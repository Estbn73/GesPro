<div>
    <!-- Tarjeta para las tareas -->
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Tareas del Proyecto</h5>
            <button class="btn btn-primary" wire:click="$set('showModal', true)">Agregar Tarea</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tareas as $tarea)
                        <tr>
                            <td>{{ $tarea->id }}</td>
                            <td>{{ $tarea->nombre_tarea }}</td>
                            <td>{{ $tarea->descripcion }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" wire:click="setItem({{ $tarea->id }})">Editar</button>
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?')"
                                    wire:click="eliminarTarea({{ $tarea->id }})">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

  <!-- Modal -->
@if ($showModal)
    <div class="modal fade show" style="display: block;" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <form wire:submit.prevent="guardar">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $tarea_id ? 'Editar Tarea' : 'Agregar Tarea' }}</h5>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Campo: Nombre de la Tarea -->
                        <div class="mb-3">
                            <label for="nombre_tarea" class="form-label">Nombre de la Tarea</label>
                            <input type="text" id="nombre_tarea" class="form-control @error('nombre_tarea') is-invalid @enderror" wire:model="nombre_tarea">
                            @error('nombre_tarea') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Campo: Descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" wire:model="descripcion"></textarea>
                            @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Campo: Asignar a Usuario -->
                        <div class="mb-3">
                        <label for="user_id" class="form-label">Asignar a Usuario</label>
                        <select id="user_id" class="form-select @error('user_id') is-invalid @enderror" wire:model="user_id">
                            <option value="">Seleccionar Usuario</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>


                        <!-- Campo: Prioridad -->
                        <div class="mb-3">
                            <label for="prioridad" class="form-label">Prioridad</label>
                            <select id="prioridad" class="form-select @error('prioridad') is-invalid @enderror" wire:model="prioridad">
                                <option value="0">Normal</option>
                                <option value="1">Alta</option>
                            </select>
                            @error('prioridad') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
</div>
