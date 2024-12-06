<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;

class Proyecto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_final',
        'estado',
    ];

    use HasFactory;

    public function equipo()
    {
        return $this->belongsToMany(User::class, 'equipo_proyecto' , 'proyecto_id', 'user_id')
                    ->withPivot('lider') 
                    ->withTimestamps();
    }
    public function equipoProyecto()
    {
        return $this->hasMany(EquipoProyecto::class, 'proyecto_id');
    }

        public function tareas()
    {
        return $this->hasMany(Tarea::class, 'proyecto_id');
    }

    public function riesgos()
    {
        return $this->hasMany(Riesgo::class);
    }

    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

}
