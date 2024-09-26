<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    protected $fillable = ['nombre', 'tipo', 'descripcion'];

    // Relación con liquidaciones: Un concepto puede aplicarse a muchas liquidaciones
    public function liquidaciones()
    {
        return $this->belongsToMany(Liquidacion::class, 'concepto_liquidaciones')
                    ->withPivot('monto_aplicado')
                    ->withTimestamps();
    }
}
