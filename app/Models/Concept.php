<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
    use HasFactory;

    protected $table = 'concept_payouts';

    /**
     * Campos asignables en el modelo.
     */
    protected $fillable = [
        'nombre',
        'tipo',
        'porcentaje',
        'monto_fijo',
        'descripcion',
    ];

    // Relación con liquidaciones: Un concepto puede aplicarse a muchas liquidaciones
    public function payouts()
    {
        return $this->belongsToMany(Payout::class, 'concept_payout_payout')
                    ->withPivot('monto_aplicado')
                    ->withTimestamps();
    }
}
