<div>
    <ul class="list-group">
        @foreach($integrantes as $integrante)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $integrante->usuario->name }}</strong> 
                    <br>
                    <small>{{ $integrante->usuario->email }}</small>
                </div>
                <span class="badge bg-primary">
                    {{ $integrante->lider ? 'Líder' : 'Desarrollador' }}
                </span>
            </li>
        @endforeach
    </ul>
</div>
