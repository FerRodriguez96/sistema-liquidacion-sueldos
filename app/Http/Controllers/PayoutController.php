<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Liquidacion;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    /**
     * Calcular la liquidación de un empleado.
     */
    public function calcularLiquidacion(User $user)
    {
        $salarioBase = $user->salario_base;
        $horasExtras = $this->calcularHorasExtras($user);
        $bonificaciones = $this->calcularBonificaciones($user);
        $deducciones = $this->calcularDeducciones($user);

        $salarioBruto = $salarioBase + $horasExtras + $bonificaciones;
        $salarioNeto = $salarioBruto - $deducciones;

        // Guardar liquidación en la base de datos
        $liquidacion = Liquidacion::create([
            'empleado_id' => $user->id,
            'salario_bruto' => $salarioBruto,
            'salario_neto' => $salarioNeto,
            'horas_extras' => $horasExtras,
            'bonificaciones' => $bonificaciones,
            'deducciones' => $deducciones,
        ]);

        return view('liquidaciones.show', compact('user', 'salarioNeto', 'liquidacion'));
    }

    /**
     * Calcular las horas extras del empleado.
     */
    protected function calcularHorasExtras(User $user)
    {
        //
        return $user->horas_extras * $user->pago_hora_extra;
    }

    /**
     * Calcular las bonificaciones del empleado.
     */
    protected function calcularBonificaciones(User $user)
    {
        //
        return $user->bonificaciones;
    }

    /**
     * Calcular las deducciones del empleado.
     */
    protected function calcularDeducciones(User $user)
    {
        //
        return $user->deducciones;
    }
}
