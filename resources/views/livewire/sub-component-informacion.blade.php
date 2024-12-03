<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <h5 class="card-title text fw-bold">Detalles del Proyecto</h5>
        <hr>
        <ul class="list-unstyled">
            <li class="mb-2">
                <strong>Descripción:</strong>
                <span class="text-muted">{{ $proyecto->descripcion }}</span>
            </li>
            <li class="mb-2">
                <strong>Estado:</strong>
                <span class="badge {{ $proyecto->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                    {{ $proyecto->estado == 1 ? 'Activo' : 'Inactivo' }}
                </span>
            </li>
            <li class="mb-2">
                <strong>Fecha Inicio:</strong>
                <span class="text-muted">{{ \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('d/m/Y') }}</span>
            </li>
            <li>
                <strong>Fecha Final:</strong>
                <span class="text-muted">{{ \Carbon\Carbon::parse($proyecto->fecha_final)->format('d/m/Y') }}</span>
            </li>
        </ul>
    </div>
</div>
