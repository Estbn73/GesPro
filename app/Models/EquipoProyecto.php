<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoProyecto extends Model
{
    use HasFactory;

    protected $table = 'equipo_proyecto'; // Nombre de la tabla

    protected $fillable = [
        'proyecto_id',
        'user_id',
        'lider', 
    ];

    // Relación con el modelo Proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    // Relación con el modelo User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
