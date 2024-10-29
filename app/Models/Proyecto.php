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
    
}
