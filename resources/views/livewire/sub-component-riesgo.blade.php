<div>
    <h5>Riesgos del Proyecto</h5>

    <!-- Mostrar mensaje de éxito (opcional) -->
    @if (session()->has('mensajeExito'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('mensajeExito') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Botón para abrir el formulario -->
    <button class="btn btn-primary mb-3" wire:click="$set('mostrarFormulario', true)">
        <i class="bi bi-plus-circle me-2"></i> Agregar Riesgo
    </button>

    <!-- Formulario de Agregar Riesgo -->
    @if ($mostrarFormulario)
        <div class="card mb-4">
            <div class="card-body">
                <h6 class="mb-3">Nuevo Riesgo</h6>
                <div class="mb-3">
                    <input type="text" wire:model="nuevoRiesgo.tipo" class="form-control mb-2" placeholder="Tipo de riesgo (e.g., Técnico, Financiero)">
                    @error('nuevoRiesgo.tipo') <span class="text-danger">{{ $message }}</span> @enderror

                    <textarea wire:model="nuevoRiesgo.descripcion" class="form-control mb-2" placeholder="Descripción del riesgo"></textarea>
                    @error('nuevoRiesgo.descripcion') <span class="text-danger">{{ $message }}</span> @enderror

                    <select wire:model="nuevoRiesgo.impacto" class="form-select mb-2">
                        <option value="">Seleccionar impacto</option>
                        <option value="positivo">Positivo</option>
                        <option value="negativo">Negativo</option>
                    </select>
                    @error('nuevoRiesgo.impacto') <span class="text-danger">{{ $message }}</span> @enderror

                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success" wire:click="agregarRiesgo">Guardar</button>
                        <button class="btn btn-secondary" wire:click="$set('mostrarFormulario', false)">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Lista de Riesgos -->
    @if ($riesgos->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Impacto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riesgos as $riesgo)
                    <tr>
                        <td>{{ ucfirst($riesgo->tipo) }}</td>
                        <td>{{ $riesgo->descripcion }}</td>
                        <td>
                            <span class="badge bg-{{ $riesgo->impacto === 'positivo' ? 'success' : 'danger' }}">
                                {{ ucfirst($riesgo->impacto) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">No hay riesgos asociados a este proyecto.</p>
    @endif
</div>
