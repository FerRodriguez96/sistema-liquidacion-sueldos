<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payout;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    /**
     * Calcular la liquidación de un empleado.
     */
    public function calculatePayout(User $user)
    {
        $baseSalary = $user->base_salary;
        $extraHours = $this->calculateExtraHours($user);
        $bonuses = $this->calculateBonuses($user);
        $deductions = $this->calculateDeductions($user);

        $grossSalary = $baseSalary + $extraHours + $bonuses;
        $netSalary = $grossSalary - $deductions;

        // Guardar liquidación en la base de datos
        $payout = Payout::create([
            'user_id' => $user->id,
            'gross_salary' => $grossSalary,
            'net_salary' => $netSalary,
            'total_bonification' => $bonuses,
            'total_discount' => $deductions,
        ]);

        return view('payouts.show', compact('user', 'netSalary', 'payout'));
    }

    /**
     * Calcular las horas extras del empleado.
     */
    protected function calculateExtraHours(User $user)
    {
        return $user->extra_hours * $user->extra_hour_rate;
    }

    /**
     * Calcular las bonificaciones del empleado.
     */
    protected function calculateBonuses(User $user)
    {
        return $user->bonuses;
    }

    /**
     * Calcular las deducciones del empleado.
     */
    protected function calculateDeductions(User $user)
    {
        return $user->deductions;
    }
}
