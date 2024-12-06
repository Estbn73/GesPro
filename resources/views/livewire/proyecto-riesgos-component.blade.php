<div x-data="{showModal: $wire.entangle('showModal')}">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Gestión de Riesgos</h5>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-success mb-3 " x-on:click="showModal=true">
                <i class="fas fa-plus"></i> Agregar Riesgo
            </button>
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Impacto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riesgos as $riesgo)
                    <tr>
                        <td>{{ $riesgo->id }}</td>
                        <td>{{ $riesgo->tipo }}</td>
                        <td>{{ $riesgo->descripcion }}</td>
                        <td>{{ $riesgo->impacto }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" wire:click="setItem({{ $riesgo->id }})">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button x-on:click="if (confirm('¿Estás seguro de eliminar este riesgo?')) { $wire.eliminarRiesgo({{ $riesgo->id }}) }" class="btn btn-sm btn-danger">
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
                        <h5 class="modal-title">Gestionar Riesgo</h5>
                        <button type="button" class="btn-close" aria-label="Close" x-on:click="showModal=false" wire:click="cerrarModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Riesgo</label>
                            <input type="text" id="tipo" class="form-control" wire:model="tipo" placeholder="Ingrese el nombre del riesgo">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea id="descripcion" class="form-control" wire:model="descripcion" rows="3" placeholder="Ingrese la descripción del riesgo"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="impacto" class="form-label">Impacto:</label>
                            <select id="impacto" class="form-select" wire:model="impacto">
                                <option hidden selected>Selecciona un Impacto</option>
                                <option value="positivo">Positivo</option>
                                <option value="negativo">Negativo</option>
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