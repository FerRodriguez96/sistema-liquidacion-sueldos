<?php

namespace App\Http\Controllers;

use App\Models\Payout;
use App\Models\User;
use App\Models\Concept; // Asegúrate de que este sea el nombre correcto de tu modelo de conceptos
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function create($userId)
    {
        $user = User::findOrFail($userId);
        $concepts = Concept::all(); // Asegúrate de usar el modelo correcto aquí

        return view('payouts.create', compact('user', 'concepts'));
    }

    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $payouts = Payout::where('user_id', $userId)->get();

        return view('payouts.index', compact('user', 'payouts'));
    }

    public function show($userId, $payoutId)
    {
        // Obtener la liquidación con los conceptos relacionados
        $payout = Payout::with('user', 'concepts')->findOrFail($payoutId);

        return view('payouts.show', compact('payout'));
    }

    public function store(Request $request)
    {
        // Validar los datos de la liquidación
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'payout_date' => 'required|date',
            'concepts' => 'required|array',
            'concepts.*.id' => 'required|exists:concept_payouts,id', // Asegúrate de usar el nombre correcto de la tabla
            'concepts.*.monto_aplicado' => 'required|numeric',
        ]);

        $user = User::findOrFail($validated['user_id']);
        $baseSalary = $user->jobTitle->base_salary;

        // Crear la liquidación
        $payout = Payout::create([
            'user_id' => $validated['user_id'],
            'payout_date' => $validated['payout_date'],
            'gross_salary' => $baseSalary, // Puedes calcular esto después si es necesario
            'net_salary' => 0, // Inicialmente a 0
        ]);

        // Preparar los datos para la tabla pivote
        $conceptsData = [];
        foreach ($validated['concepts'] as $concept) {
            $conceptsData[$concept['id']] = [
                'monto_aplicado' => $concept['monto_aplicado'],
            ];
        }

        // Asociar los conceptos a la liquidación
        $payout->concepts()->attach($conceptsData);

        // Calcular el salario neto
        $netSalary = $this->calculateNetSalary($user);
        $payout->update(['net_salary' => $netSalary]);

        return redirect()->route('empleados')->with('success', 'Liquidación creada correctamente.');
    }

    private function calculateRemunerative(User $user)
    {
        // Obtener todos los conceptos de tipo remunerativo
        $remunerativeConcepts = Concept::where('tipo', 'remunerativo')->get();

        $totalRemunerative = 0;

        foreach ($remunerativeConcepts as $concept) {
            // Calcula el monto según si es un porcentaje o monto fijo
            $amount = $concept->porcentaje
                ? $user->jobTitle->base_salary * ($concept->porcentaje / 100)
                : $concept->monto_fijo;

            $totalRemunerative += $amount;
        }

        return $totalRemunerative;
    }

    private function calculateNonRemunerative(User $user)
    {
        // Obtener todos los conceptos de tipo no remunerativo
        $nonRemunerativeConcepts = Concept::where('tipo', 'no_remunerativo')->get();

        $totalNonRemunerative = 0;

        foreach ($nonRemunerativeConcepts as $concept) {
            // Calcula el monto según si es un porcentaje o monto fijo
            $amount = $concept->porcentaje
                ? $user->jobTitle->base_salary * ($concept->porcentaje / 100)
                : $concept->monto_fijo;

            $totalNonRemunerative += $amount;
        }

        return $totalNonRemunerative;
    }

    private function calculateDeductions(User $user)
    {
        // Obtener todos los conceptos que son deducciones
        $deductions = Concept::where('tipo', 'deduccion')->get();

        $totalDeductions = 0;

        foreach ($deductions as $deduction) {
            // Calcula el monto según si es un porcentaje o monto fijo
            $amount = $deduction->porcentaje
                ? $user->jobTitle->base_salary * ($deduction->porcentaje / 100)
                : $deduction->monto_fijo;

            $totalDeductions += $amount;
        }

        return $totalDeductions;
    }

    public function calculateExtraHours(User $user)
    {
        $baseRate = $user->jobTitle->base_salary / 160; // Suponiendo 160 horas de trabajo mensual
        $extraHours = $user->extra_hours;

        // Suponiendo que el `extra_hour_rate` se aplica a las horas extra normales
        $normalExtraRate = $baseRate * 1.5; // 50% adicional para horas extras
        return $extraHours * $normalExtraRate;
    }

    private function calculateGrossSalary(User $user)
    {
        $baseSalary = $user->jobTitle->base_salary;
        $remunerativeTotal = $this->calculateRemunerative($user);

        return $baseSalary + $remunerativeTotal;
    }

    private function calculateNetSalary(User $user)
    {
        $grossSalary = $this->calculateGrossSalary($user);
        $deductions = $this->calculateDeductions($user);
        $nonRemunerativeTotal = $this->calculateNonRemunerative($user);

        return $grossSalary - ($deductions + $nonRemunerativeTotal);
    }
}
