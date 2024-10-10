<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gross_salary',
        'total_discount',
        'total_bonification',
        'net_salary',
    ];

    // Relación con usuarios: Cada liquidación pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con conceptos de liquidación: Una liquidación puede tener muchos conceptos
    public function concepts()
    {
        return $this->belongsToMany(Concept::class, 'concept_payouts')
                    ->withPivot('applied_amount')
                    ->withTimestamps();
    }
}
