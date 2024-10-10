<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'description'];

    // Relación con liquidaciones: Un concepto puede aplicarse a muchas liquidaciones
    public function payouts()
    {
        return $this->belongsToMany(Payout::class, 'concept_payouts')
                    ->withPivot('applied_amount')
                    ->withTimestamps();
    }
}
