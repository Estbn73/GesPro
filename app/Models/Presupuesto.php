<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    use HasFactory;

    protected $fillable = [
        'proyecto_id',
        'monto',
        'descripcion'
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
