<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    protected $fillable = [
                'empleado_id',
                'salario_bruto',
                'descuento_total',
                'bonificacion_total',
                'salario_neto'
    ];

    // Relación con empleados: Cada liquidación pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con conceptos de liquidación: Una liquidación puede tener muchos conceptos
    public function conceptos()
    {
        return $this->belongsToMany(Concepto::class, 'concepto_liquidacion')
                    ->withPivot('monto_aplicado')
                    ->withTimestamps();
    }
}
