<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riesgo extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'descripcion',
        'impacto',
        'proyecto_id',
    ];

    public function proyecto()
{
    return $this->belongsTo(Proyecto::class);
}

}
