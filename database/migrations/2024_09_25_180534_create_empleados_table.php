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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->string('nombre');
            $table->string('apellido');
            $table->string('dni')->unique();
            $table->string('email')->unique();
            $table->string('cargo');
            $table->decimal('salario_base', 8, 2); // Salario con 8 dígitos, 2 decimales
            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
