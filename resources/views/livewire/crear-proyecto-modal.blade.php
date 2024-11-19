<div>
    <!-- Botón para abrir el modal -->
    <button class="btn btn-primary" wire:click="abrirModal">Crear Proyecto</button>

    <!-- Modal -->
    @if ($showModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crear Proyecto</h5>
                        <button type="button" class="btn-close" wire:click="cerrarModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="guardarProyecto">
                            <div class="mb-3 row">
                                <label for="nombre" class="col-md-3 col-form-label text-end">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" id="nombre" class="form-control" wire:model="nombre" placeholder="Ingresa el nombre del proyecto">
                                    @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="descripcion" class="col-md-3 col-form-label text-end">Descripción</label>
                                <div class="col-md-9">
                                    <textarea id="descripcion" class="form-control" wire:model="descripcion" placeholder="Ingresa la descripcion del proyecto"></textarea>
                                    @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="fecha_inicio" class="col-md-3 col-form-label text-end">Fecha Inicio</label>
                                <div class="col-md-3">
                                    <input type="date" id="fecha_inicio" class="form-control" wire:model="fecha_inicio">
                                    @error('fecha_inicio') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <label for="fecha_final" class="col-md-3 col-form-label text-end">Fecha Final</label>
                                <div class="col-md-3">
                                    <input type="date" id="fecha_final" class="form-control" wire:model="fecha_final">
                                    @error('fecha_final') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="estado" class="col-md-3 col-form-label text-end">Estado</label>
                                <div class="col-md-9">
                                    <select id="estado" class="form-select" wire:model="estado">
                                        <option value="0">Inactivo</option>
                                        <option value="1">Activo</option>
                                    </select>
                                    @error('estado') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-secondary">Guardar</button>
                                <button type="button" class="btn btn-success" wire:click="cerrarModal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
