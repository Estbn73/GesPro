<div>
    <p><strong>Descripción:</strong> {{ $proyecto->descripcion }}</p>
    <p><strong>Estado:</strong> {{ $proyecto->estado == 1 ? 'Activo' : 'Inactivo' }}</p>
    <p><strong>Fecha Inicio:</strong> {{ $proyecto->fecha_inicio }}</p>
    <p><strong>Fecha Final:</strong> {{ $proyecto->fecha_final }}</p>
</div>
