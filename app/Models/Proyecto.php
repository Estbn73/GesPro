<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsToMany(User::class, 'equipo_proyecto')
                    ->withPivot('lider') 
                    ->withTimestamps();
    }

        public function tareas()
    {
        return $this->hasMany(Tarea::class, 'proyecto_id');
        return $this->hasMany(Tarea::class);
    }

        public function riesgos()
    {
        return $this->hasMany(Riesgo::class);
    }

    public function presupuesto()
    {
        return $this->hasOne(Presupuesto::class);
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
