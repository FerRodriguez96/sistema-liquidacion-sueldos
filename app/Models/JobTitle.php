<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'base_salary'
    ];

    // Relación con el modelo User: Un cargo puede ser asignado a muchos usuarios
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
