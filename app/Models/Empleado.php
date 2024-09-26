<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    // Definir los campos que pueden ser llenados masivamente
    protected $fillable = ['nombre', 'apellido', 'dni', 'email', 'salario_base', 'cargo'];

    // Relación con las liquidaciones: Un empleado tiene muchas liquidaciones
    public function liquidaciones()
    {
        return $this->hasMany(Liquidacion::class);
    }
}
