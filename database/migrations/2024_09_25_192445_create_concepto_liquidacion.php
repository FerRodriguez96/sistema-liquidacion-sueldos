<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('concepto_liquidacion', function (Blueprint $table) {
            $table->id(); // ID único para la tabla intermedia
            $table->foreignId('liquidacion_id')->constrained('liquidaciones')->onDelete('cascade'); // Relación con liquidaciones
            $table->foreignId('concepto_id')->constrained('conceptos_liquidaciones')->onDelete('cascade'); // Relación con conceptos de liquidación
            $table->decimal('monto_aplicado', 10, 2); // Monto aplicado (si es porcentaje, calcula en base al salario)
            $table->timestamps(); // Fechas de creación y modificación
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concepto_liquidacion');
    }
};
