<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payout_date',
        // Agrega otros campos que necesites, como gross_salary, net_salary, etc.
    ];

    // Relación con la tabla usuarios
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con los conceptos de liquidaciones
    public function concepts()
    {
        return $this->belongsToMany(Concept::class, 'concept_payout_payout', 'liquidacion_id', 'concepto_id')
                    ->withPivot('monto_aplicado')
                    ->withTimestamps();
    }
}
