<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_tarea',
        'descripcion',
        'proyecto_id',
        'estado',
        'user_id',
        'prioridad',
        'fecha_inicio',
        'fecha_final',
    ];
    protected $casts = [
        'fecha_final' => 'datetime',
    ];
    
    

    // Definir la relación con el modelo Proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

        public function user()
    {
        return $this->belongsTo(User::class);
    }

}

