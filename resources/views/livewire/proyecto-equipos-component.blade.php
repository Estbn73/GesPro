<div x-data="{showModal: $wire.entangle('showModal')}">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Gestión de Equipo del Proyecto</h5>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-success mb-3" x-on:click="showModal=true">
                <i class="fas fa-plus"></i> Agregar Miembro
            </button>
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Líder</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipo as $miembro)
                    <tr>
                        <td>{{ $miembro->id }}</td>
                        <td>{{ $miembro->name ?? 'Usuario no encontrado' }}</td>
                        <td>{{ $miembro->pivot->lider ? 'Sí' : 'No' }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" wire:click="setItem({{ $miembro->id }})">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button x-on:click="if (confirm('¿Estás seguro de eliminar a este miembro?')) { $wire.eliminarMiembro({{ $miembro->id }}) }" class="btn btn-sm btn-danger">
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
                        <h5 class="modal-title">Gestionar Miembro del Proyecto</h5>
                        <button type="button" class="btn-close" aria-label="Close" x-on:click="showModal=false" wire:click="cerrarModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Usuario</label>
                            <select id="user_id" class="form-control" wire:model="user_id">
                                <option value="">Seleccione un usuario</option>
                                @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="lider" class="form-label">¿Es Líder?</label>
                            <select id="lider" class="form-control" wire:model="lider">
                                <option value="0">No</option>
                                <option value="1">Sí</option>
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