<div>
    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Formulario de creación/edición de riesgos -->
    <form wire:submit.prevent="{{ $selectedRiesgo ? 'update' : 'store' }}">

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" wire:model="tipo" class="form-control" id="tipo" required>
            @error('tipo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea wire:model="descripcion" class="form-control" id="descripcion" rows="3" required></textarea>
            @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="impacto" class="form-label">Impacto</label>
            <input type="number" wire:model="impacto" class="form-control" id="impacto" required min="1" max="5">
            @error('impacto') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ $selectedRiesgo ? 'Actualizar' : 'Guardar' }}</button>
        <button type="button" class="btn btn-secondary" wire:click="resetForm">Cancelar</button>
    </form>

    <!-- Lista de riesgos -->
    <ul class="list-group mt-4">
        @foreach ($riesgos as $riesgo)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>Tipo:</strong> {{ $riesgo->tipo }}<br>
                    <strong>Descripción:</strong> {{ $riesgo->descripcion }}<br>
                    <strong>Impacto:</strong> {{ $riesgo->impacto }}
                </div>
                <div>
                    <button class="btn btn-warning btn-sm" wire:click="edit({{ $riesgo->id }})">Editar</button>
                    <button class="btn btn-danger btn-sm" wire:click="delete({{ $riesgo->id }})" onclick="confirm('¿Estás seguro de eliminar este riesgo?') || event.stopImmediatePropagation()">Eliminar</button>
                </div>
            </li>   
        @endforeach
    </ul>
</div>
