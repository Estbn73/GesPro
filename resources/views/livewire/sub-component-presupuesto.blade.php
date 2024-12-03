<div>
    <h5>Presupuesto del Proyecto</h5>

    @if ($presupuesto)
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Monto:</strong> ${{ number_format($presupuesto->monto, 2) }}</p>
                <p><strong>Descripción:</strong> {{ $presupuesto->descripcion }}</p>
            </div>
        </div>
    @else
        <p class="text-muted">No hay un presupuesto asignado para este proyecto.</p>
    @endif
</div>
