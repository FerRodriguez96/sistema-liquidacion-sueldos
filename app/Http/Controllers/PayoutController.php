<?php

namespace App\Http\Controllers;

use App\Models\Payout;
use App\Models\User;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function create($userId)
    {
        // Busca el usuario por su ID
        $user = User::findOrFail($userId);
    
        // Retorna la vista de creación de liquidación con el usuario
        return view('payouts.create', compact('user'));
    }
    
    // En PayoutController.php
    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $payouts = Payout::where('user_id', $userId)->get();

        return view('payouts.index', compact('user', 'payouts'));
    }

    public function show($userId, $payoutId)
    {
        $user = User::findOrFail($userId);
        $payout = Payout::findOrFail($payoutId);

        return view('payouts.show', compact('user', 'payout'));
    }

    public function store(Request $request)
    {
        // Validar los datos de la liquidación
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'payout_date' => 'required|date',
        ]);

        // Obtener el usuario y su salario base
        $user = User::findOrFail($validated['user_id']);
        $baseSalary = $user->jobTitle->base_salary; // Obtener el salario base del cargo

        // Calcular los aportes usando una función en el controlador
        $contributions = $this->calculateContributions($baseSalary);

        // Crear la liquidación con los aportes calculados
        Payout::create([
            'user_id' => $validated['user_id'],
            'payout_date' => $validated['payout_date'],
            'gross_salary' => $baseSalary,
            'retirement_contribution' => $contributions['retirement'],
            'health_contribution' => $contributions['health'],
            'risk_contribution' => $contributions['risk'],
            'unemployment_contribution' => $contributions['unemployment'],
            'total_contributions' => $contributions['total'],
            'net_salary' => $baseSalary - $contributions['total'],
        ]);

        return redirect()->route('empleados')->with('success', 'Liquidación creada correctamente.');
    }

    // Función para calcular los aportes
    private function calculateContributions($baseSalary)
    {
        $retirementRate = 0.11; // 11% para jubilación
        $healthRate = 0.03; // 3% para obra social
        $riskRate = 0.01; // 1% para ART
        $unemploymentRate = 0.02; // 2% para desempleo

        // Cálculos
        $retirement = $baseSalary * $retirementRate;
        $health = $baseSalary * $healthRate;
        $risk = $baseSalary * $riskRate;
        $unemployment = $baseSalary * $unemploymentRate;
        $total = $retirement + $health + $risk + $unemployment;

        return [
            'retirement' => $retirement,
            'health' => $health,
            'risk' => $risk,
            'unemployment' => $unemployment,
            'total' => $total,
        ];
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
