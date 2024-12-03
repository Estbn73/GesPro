<div x-data="{showModal: $wire.entangle('showModal')}">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Gestión de Tareas</h5>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-success mb-3" x-on:click="showModal=true">
                <i class="fas fa-plus"></i> Agregar Tarea
            </button>
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre de la Tarea</th>
                        <th>Descripción</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Final</th>
                        <th>Usuario Designado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tareas as $tarea)
                    <tr>
                        <td>{{ $tarea->id }}</td>
                        <td>{{ $tarea->nombre_tarea }}</td>
                        <td>{{ $tarea->descripcion }}</td>
                        <td>{{ \Carbon\Carbon::parse($tarea->fecha_inicio)->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($tarea->fecha_final)->format('Y-m-d') }}</td>
                        <td>{{ $tarea->user_id ? \App\Models\User::find($tarea->user_id)->name : 'Sin asignar' }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" wire:click="setItem({{ $tarea->id }})">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button x-on:click="if (confirm('¿Estás seguro de eliminar esta tareas?')) { $wire.eliminarTareas({{ $tarea->id }}) }" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div
        x-bind:class="!showModal ? 'modal fade' : 'modal fade show'"
        x-bind:aria-hidden="!showModal ? 'true' : 'false'"
        x-bind:style="!showModal ? '' : 'display: block;'"
        x-bind:role="!showModal ? '' : 'dialog'"
        style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="guardar">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Gestionar Tarea</h5>
                        <button type="button" class="btn-close" aria-label="Close" x-on:click="showModal=false" wire:click="cerrarModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombre_tarea" class="form-label">Nombre de la Tarea</label>
                            <input type="text" id="nombre_tarea" class="form-control" wire:model="nombre_tarea" placeholder="Ingrese el nombre de la tarea">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea id="descripcion" class="form-control" wire:model="descripcion" rows="3" placeholder="Ingrese la descripción de la tarea"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" id="fecha_inicio" class="form-control" wire:model="fecha_inicio">
                        </div>
                        <div class="mb-3">
                            <label for="fecha_final" class="form-label">Fecha Final</label>
                            <input type="date" id="fecha_final" class="form-control" wire:model="fecha_final">
                        </div>
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Asignar a Usuario</label>
                            <select id="user_id" class="form-select" wire:model="user_id">
                                <option value="">-- Seleccione un Usuario --</option>
                                @foreach(\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" x-on:click="showModal=false" wire:click="cerrarModal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
