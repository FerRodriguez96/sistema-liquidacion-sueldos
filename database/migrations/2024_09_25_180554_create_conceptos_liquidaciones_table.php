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
        Schema::create('conceptos_liquidaciones', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->string('nombre'); // Nombre del concepto
            $table->enum('tipo', ['remunerativo', 'no remunerativo', 'aporte', 'deduccion']); // Tipo de concepto
            $table->decimal('porcentaje', 5, 2)->nullable(); // Porcentaje si aplica
            $table->decimal('monto_fijo', 10, 2)->nullable(); // Monto fijo si aplica
            $table->text('descripcion')->nullable(); // Descripción adicional
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conceptos_liquidaciones');
    }
};
